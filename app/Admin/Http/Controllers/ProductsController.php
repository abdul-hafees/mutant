<?php

namespace App\Admin\Http\Controllers;

use App\Enums\ProductType;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Hub;
use App\Models\Product;
use App\Models\ProductAttributeValue;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $query = Product::query()
                ->where('type', ProductType::BASE_PRODUCT()->value)
                ->with('hub')
                ->orderBy('updated_at', 'desc');
            return DataTables::of($query)
                ->filter(function ($query) {
                    if (request()->filled('filter.search')) {
                        $query->where(function ($query) {
                            $query->where('name', 'like', "%" . request('filter.search') . "%");
                        });
                    }
                })
                ->editColumn('hub_id', function ($product) {
                    return optional($product->hub)->name;
                })
                ->editColumn('type', function ($product) {
                    return optional($product->type)->label;
                })
                ->setRowClass(function ($product) {
                    return $product->type == ProductType::BASE_PRODUCT() ? 'bg-light' : 'bg-white';
                })
                ->addColumn('action', function ($product) {
                    return view('admin::pages.products.action', compact('product'));
                })
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'base_name', 'name' => 'base_name', 'title' => 'Name'],
            ['data' => 'type', 'name' => 'type', 'title' => 'Type'],
            ['data' => 'variant_name', 'name' => 'variant_name', 'title' => 'Variant Name'],
            ['data' => 'hub_id', 'name' => 'hub_id', 'title' => 'Hub'],
            ['data' => 'price', 'name' => 'price', 'title' => 'Price'],
            ['data' => 'discount_price', 'name' => 'discount_price', 'title' => 'Discount'],
            ['data' => 'available_stock_qty', 'name' => 'available_stock_qty', 'title' => 'Available Quantity'],
        ])
            ->parameters([
                'searching' => false,
                'ordering' => false,
                'pageLength' => 15
            ])
            ->addAction(['title' => '', 'class' => 'text-right p-3', 'width' => 120]);

        return view('admin::pages.products.index', compact('html'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with('sub_categories')
            ->whereNull('parent_id')
            ->get();

        $hubs = Hub::cursor();

        return view('admin::pages.products.create',
            compact('categories',
                'hubs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'base_name' => 'required|max:191',
            'price' => 'nullable|required_if:is_variants,off|min:1',
            'available_stock_qty' => 'required_unless:is_variants,on',
            'description' => 'nullable|max:300',
            'category_id' => 'nullable|exists:categories,id',
            'hub_id' => 'required|exists:hubs,id',
        ]);


        if ($request->is_variants && !$request->input('variant_name')) {
            return redirect()->back()->with('error', "Please add variants if the product have variants");
        }

        $product = new Product();
        $product->base_name = $request->base_name;
        $product->price = $request->price;
        $product->weight = $request->weight;
        $product->discount_price = $request->discount_price;
        $product->type = ProductType::BASE_PRODUCT();
        $product->available_stock_qty = $request->available_stock_qty;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->hub_id = $request->hub_id;
        $product->tax = null;
        $product->is_available = $request->filled('is_available') ? true : false;
        if (!$request->is_variants) {
            $product->is_display = true;
        }
        $product->save();

        $images = $request->file('images') ?? [];

        if (count($images) > 0) {
            foreach ($images as $image) {
                if (is_file($image)) {
                    $product->addMedia($image)->toMediaCollection('images');
                }
            }
        }

        if ($request->is_variants) {

            $variantPrices = $request->input('variant_price');
            $variantNames = $request->input('variant_name');
            $variantDiscountPrices = $request->input('variant_discount');
            $variantQty = $request->input('variant_qty');

            foreach ($variantDiscountPrices as $key => $variantDiscountPrice) {
                $variantProduct = new Product();
                $variantProduct->base_name = $request->base_name;
                $variantProduct->base_product_id = $product->id;
                $variantProduct->variant_name = $variantNames[$key];
                $variantProduct->price = $variantPrices[$key];
                $variantProduct->discount_price = $variantDiscountPrices[$key];
                $variantProduct->tax = null;
                $variantProduct->available_stock_qty = $variantQty[$key];
                $variantProduct->description = $request->description;
                $variantProduct->type = ProductType::VARIANT_PRODUCT();
                $variantProduct->is_display = true;
                $variantProduct->category_id = $request->category_id;
                $variantProduct->hub_id = $request->hub_id;
                $variantProduct->weight = $request->weight;
                $variantProduct->is_available = $request->filled('is_available')
                    ? true
                    : false;
                $variantProduct->save();

                $attributeIDs = json_decode($request->input('selectedAttributeIds'));;

                foreach ($attributeIDs as $option => $attributeID) {
                    $attributeOptionIds = $request->input('attribute-option-' . $option);
                    $productAttributeOption = new ProductAttributeValue();
                    $productAttributeOption->product_id = $variantProduct->id;
                    $productAttributeOption->attribute_id = $attributeID;
                    $productAttributeOption->attribute_value_id = $attributeOptionIds[$key];
                    $productAttributeOption->base_product_id = $product->id;
                    $productAttributeOption->save();
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', "Successfully Created");
    }

    public function show(Builder $builder, Product $product)
    {
        if (request()->ajax()) {
            $query = $product->variants()
                ->with('hub')
                ->orderBy('updated_at', 'desc');
            return DataTables::of($query)
                ->filter(function ($query) {
                    if (request()->filled('filter.search')) {
                        $query->where(function ($query) {
                            $query->where('name', 'like', "%" . request('filter.search') . "%");
                        });
                    }
                })
                ->editColumn('hub_id', function ($product) {
                    return optional($product->hub)->name;
                })
                ->editColumn('type', function ($product) {
                    return optional($product->type)->label;
                })
                ->setRowClass(function ($product) {
                    return $product->type == ProductType::BASE_PRODUCT() ? 'bg-light' : 'bg-white';
                })
                ->addColumn('action', function ($product) {
                    return view('admin::pages.products.action', compact('product'));
                })
                ->make(true);
        }

        $html = $builder->columns([
            ['data' => 'base_name', 'name' => 'base_name', 'title' => 'Name'],
            ['data' => 'type', 'name' => 'type', 'title' => 'Type'],
            ['data' => 'variant_name', 'name' => 'variant_name', 'title' => 'Variant Name'],
            ['data' => 'hub_id', 'name' => 'hub_id', 'title' => 'Hub'],
            ['data' => 'price', 'name' => 'price', 'title' => 'Price'],
            ['data' => 'discount_price', 'name' => 'discount_price', 'title' => 'Discount'],
            ['data' => 'available_stock_qty', 'name' => 'available_stock_qty', 'title' => 'Available Quantity'],
        ])
            ->parameters([
                'searching' => false,
                'ordering' => false,
                'pageLength' => 15
            ])
            ->addAction(['title' => '', 'class' => 'text-right p-3', 'width' => 120]);

        return view('admin::pages.products.show', compact('html', 'product'));
    }


    public function edit($id)
    {
        $product = Product::with('media')->findOrFail($id);

        $hubs = Hub::cursor();
        $categories = Category::query()
            ->whereNull('parent_id')
            ->cursor();

        $selectedProductAttributes = ProductAttributeValue::query()
            ->where('base_product_id', $product->id)
            ->pluck('attribute_id')
            ->unique();

        $attributes = [];

        foreach ($selectedProductAttributes as $selectedProductAttribute) {
            $attribute = Attribute::where('id', $selectedProductAttribute)
                ->first();
            array_push($attributes, $attribute);
        }

        $productVariants = ProductAttributeValue::with(
            'product',
            'attribute',
            'attributeValue'
        )
            ->where('base_product_id', $product->id)
            ->get();

        $selectedProductVariants = [];


        foreach ($productVariants as $productVariant) {
            $productId = $productVariant->product_id;

            $productExist = array_search($productId, array_column($selectedProductVariants, 'product_id'));

            if ($productExist !== false) {
                $selectedProductVariants[$productExist]['attributes'][] = [
                    'attribute_id' => $productVariant->attribute_id,
                    'attribute_name' => $productVariant->attribute->name,
                    'attribute_value_id' => $productVariant->attribute_value_id,
                    'attribute_value_name' => $productVariant->attributeValue->name,
                    'attribute_values' => AttributeValue::where('attribute_id',
                        $productVariant->attribute_id)->get(),
                ];
            } else {
                $selectedProductVariants[] = [
                    'product_id' => $productId,
                    'variant_name' => $productVariant->product->variant_name,
                    'available_stock_qty' => $productVariant->product->available_stock_qty,
                    'price' => $productVariant->product->price,
                    'discount_price' => $productVariant->product->discount_price,
                    'attributes' => [
                        [
                            'attribute_id' => $productVariant->attribute_id,
                            'attribute_name' => $productVariant->attribute->name,
                            'attribute_values' => AttributeValue::where('attribute_id',
                                $productVariant->attribute_id)->get(),
                            'attribute_value_id' => $productVariant->attribute_value_id,
                            'attribute_value_name' => $productVariant->attributeValue->name,
                        ],
                    ],
                ];
            }
        }

        return view('admin::pages.products.edit',
            compact('categories',
                'product',
                'hubs',
                'attributes',
                'selectedProductVariants'
            ));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'base_name' => 'required|max:191',
            'price' => 'nullable|required_unless:is_variants,on|min:1',
            'available_stock_qty' => 'required_unless:is_variants,on',
            'description' => 'nullable|max:300',
            'hub_id' => 'nullable|exists:hubs,id'
        ]);

        if ($product->type == ProductType::VARIANT_PRODUCT()->value) {
            $product->variant_name = $request->base_name;
        } else {
            $product->base_name = $request->base_name;
        }
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->available_stock_qty = $request->available_stock_qty;
        $product->description = $request->description;
        $product->hub_id = $request->hub_id;
        $product->weight = $request->weight;
        $product->tax = null;
        $product->is_available = $request->filled('is_available') ? true : false;
        $product->save();

        $images = $request->file('images') ?? [];

        if (count($images) > 0) {
            foreach ($images as $image) {
                if (is_file($image)) {
                    $product->addMedia($image)->toMediaCollection('images');
                }
            }
        }

        if ($request->is_variants) {

            $variantPrices = $request->input('variant_price');
            $variantNames = $request->input('variant_name');
            $variantDiscountPrices = $request->input('variant_discount');
            $variantProductIds = $request->input('variant_product_id');
            $variantQty = $request->input('variant_qty');

            foreach ($variantDiscountPrices as $key => $variantDiscountPrice) {
                if ($variantProductIds[$key]) {
                    $variantProduct = Product::find($variantProductIds[$key]);
                    $productAttributeOptionExists = ProductAttributeValue::where('product_id', $variantProductIds[$key])
                        ->get();
                    foreach ($productAttributeOptionExists as $productAttributeOptionExist) {
                        $productAttributeOptionExist->delete();
                    }
                } else {
                    $variantProduct = new Product();
                }

                $variantProduct->base_name = $request->base_name;
                $variantProduct->variant_name = $variantNames[$key];
                $variantProduct->price = $variantPrices[$key];
                $variantProduct->discount_price = $variantDiscountPrices[$key];
                $variantProduct->tax = null;
                $variantProduct->available_stock_qty = $variantQty[$key];
                $variantProduct->description = $request->description;
                $variantProduct->type = ProductType::VARIANT_PRODUCT();
                $variantProduct->is_display = true;
                $variantProduct->category_id = $product->category_id;
                $variantProduct->hub_id = $request->hub_id;
                $variantProduct->weight = $request->weight;
                $variantProduct->is_available = $request->filled('is_available')
                    ? true
                    : false;
                $variantProduct->save();

                $attributeIDs = json_decode($request->input('selectedAttributeIds'));

                foreach ($attributeIDs as $option => $attributeID) {
                    $attributeOptionIds = $request->input('attribute-option-' . $option);
                    $productAttributeOption = new ProductAttributeValue();
                    $productAttributeOption->product_id = $variantProduct->id;
                    $productAttributeOption->attribute_id = $attributeID;
                    $productAttributeOption->attribute_value_id = $attributeOptionIds[$key];
                    $productAttributeOption->base_product_id = $product->id;
                    $productAttributeOption->save();
                }
            }
        }

        if($product->type == ProductType::VARIANT_PRODUCT()->value) {
            return redirect()->route('admin.products.show', $product->base_product_id)
                ->with('success', "Successfully Updated");
        }
        return redirect()->route('admin.products.index')
            ->with('success', "Successfully Updated");
    }

    public function destroy(Product $product)
    {
        if ($product->type == ProductType::BASE_PRODUCT()->value) {
            $variants = Product::query()
                ->where('base_product_id', $product->id)
                ->get();
            foreach ($variants as $variant) {
                $variant->delete();
            }
            $productAttributeValues = ProductAttributeValue::query()
                ->where('base_product_id', $product->id)
                ->get();

            foreach ($productAttributeValues as $productAttributeValue) {
                $productAttributeValue->delete();
            }
        }

        $product->delete();
        return response()->json(['message' => "Product deleted"],
            Response::HTTP_OK);
    }

    public function deleteProductImage(Request $request, $imageId)
    {
        $media = Media::find($imageId);
        if ($media) {
            $media->delete();
            return response()->json(['message' => "image deleted"], Response::HTTP_OK);
        }

        return response()->json(['message' => "No images found"], 404);
    }
}
