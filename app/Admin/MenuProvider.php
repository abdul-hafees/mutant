<?php

namespace App\Admin;

use function Webmozart\Assert\Tests\StaticAnalysis\true;

class MenuProvider
{
    /**
     * Category
     * -----------------------------------------------------------------------------------------
     *  [
     *      'is_category' => true,      // required, boolean, default: true
     *      'label' => 'DASHBOARD',     // required, string
     *      'visible' => true,          // optional, boolean, default: true
     *  ]
     *
     * =========================================================================================
     *
     * Item
     * -----------------------------------------------------------------------------------------
     *  [
     *      'label' => 'Dashboard',                         // required, string
     *      'icon' => 'wb-dashboard',                       // required, string
     *      'url' => '',                                    // optional, string,            default: null
     *      'route' => '',                                  // optional, string,            default: null
     *      'action' => '',                                 // optional, string,            default: null
     *      'sub_route_names' => ['home', 'firm_feed'],     // optional, string|array|null, default: null
     *      'sub_route_actions' => ['home', 'firm_feed'],   // optional, string|array|null, default: null
     *      'sub_route_prefixes' => [],                     // optional, string|array|null, default: null
     *      'visible' => true,                              // optional, boolean,           default: true
     *      'info' => 'Info abou this menu',                // optional, string,            default: null
     *  ]
     *
     * Item with sub menu
     * -----------------------------------------------------------------------------------------
     *  [
     *      'label' => 'Dashboard',                         // required, string
     *      'icon' => 'wb-dashboard',                       // required, string
     *      'visible' => true,                              // optional, boolean,           default: true
     *      'sub_menus' => [Item: refer above Item],        // optional, string|array|null, default: null
     *  ]
     *
     */

    public static function getMenu() {
        return [
            [
                'label' => 'Dashboard',
                'icon'  => 'wb-dashboard',
                'route' => 'admin.home',
                'visible' => function () {
                    return true;
                }
            ],
            [
                'label' => 'Banners',
                'icon'  => 'fa fa-users',
                'route' => 'admin.banners.index',
                'sub_route_names' => ['admin.banners.create', 'admin.banners.edit'],
                'visible' => function () {
                    return true;
                }
            ],
            [
                'label' => 'Hubs',
                'icon'  => 'fa fa-users',
                'route' => 'admin.hubs.index',
                'sub_route_names' => ['admin.hubs.create', 'admin.hubs.edit'],
                'visible' => function () {
                    return true;
                }
            ],
            [
                'label' => 'Manage Products',
                'icon'  => 'fas fa-cog',
                'sub_route_names' => [
                    'admin.categories.index',
                    'admin.categories.show',
                    'admin.categories.create',
                    'admin.categories.subcategories.create',
                    'admin.categories.edit',
                    'admin.attributes.index',
                    'admin.attributes.create',
                    'admin.attributes.edit',
                    'admin.attribute-values.index',
                    'admin.attribute-values.create',
                    'admin.attribute-values.edit',
                    'admin.products.index',
                    'admin.products.create',
                    'admin.products.edit',
                ],
                'visible' => function () {
                    return true;
                },
                'sub_menus' =>[
                    [
                        'label' => 'Categories',
                        'icon'  => 'fa-users',
                        'route' => 'admin.categories.index',
                        'sub_route_names' => ['admin.categories.create', 'admin.categories.edit', 'admin.categories.show', 'admin.categories.subcategories.create'],
                        'visible' => function () {
                            return true;
                        }
                    ],
                    [
                        'label' => 'Attributes',
                        'icon'  => 'fa-users',
                        'route' => 'admin.attributes.index',
                        'sub_route_names' => ['admin.attributes.create', 'admin.attributes.edit'],
                        'visible' => function () {
                            return true;
                        }
                    ],
                    [
                        'label' => 'Attribute Values',
                        'icon'  => 'fa-users',
                        'route' => 'admin.attribute-values.index',
                        'sub_route_names' => ['admin.attribute-values.create', 'admin.attribute-values.edit'],
                        'visible' => function () {
                            return true;
                        }
                    ],

                    [
                        'label' => 'Products',
                        'icon'  => 'fa-users',
                        'route' => 'admin.products.index',
                        'sub_route_names' => ['admin.products.create', 'admin.products.edit'],
                        'visible' => function () {
                            return true;
                        }
                    ],
                ]
            ],
            [
                'label' => 'Coupons',
                'icon'  => 'fa fa-users',
                'route' => 'admin.coupons.index',
                'sub_route_names' => ['admin.coupons.create', 'admin.coupons.edit'],
                'visible' => function () {
                    return true;
                }
            ],
            [
                'label' => 'Orders',
                'icon'  => 'fa fa-users',
                'route' => 'admin.orders.index',
                'sub_route_names' => ['admin.orders.show'],
                'visible' => function () {
                    return true;
                }
            ],


        ];
    }
}

