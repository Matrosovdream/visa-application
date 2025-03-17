<?php
namespace App\References;

class DashboardReferences {

    public static function sidebarMenu() {

        return array(
            array(
                'title' => 'Store',
                'url' => '',
                'icon' => 'ki-basket',
                'roles' => ['admin', 'manager'],
                'childs' => array(
                    array(
                        'title' => 'Products',
                        'url' => route('dashboard.products.index'),
                        'roles' => ['admin', 'manager'],
                    ),
                    array(
                        'title' => 'Orders',
                        'url' => route('dashboard.orders.index'),
                        'roles' => ['admin', 'manager'],
                    ),
                    array(
                        'title' => 'Payment gateways',
                        'url' => route('dashboard.gateways.index'),
                        'roles' => ['admin'],
                    ),
                    array(
                        'title' => 'Order fields',
                        'url' => route('dashboard.orderfields.index'),
                        'roles' => ['admin'],
                    ),
                    array(
                        'title' => 'Traveller fields',
                        'url' => route('dashboard.travellerfields.index'),
                        'roles' => ['admin'],
                    ),

                ),
            ),
            array(
                'title' => 'Content',
                'url' => '',
                'icon' => 'ki-file',
                'roles' => ['admin', 'manager'],
                'childs' => array(
                    array(
                        'title' => 'Articles',
                        'url' => route('dashboard.articles.index'),
                        'roles' => ['admin', 'manager'],
                    ),
                    array(
                        'title' => 'Article Groups',
                        'url' => route('dashboard.articlegroups.index'),
                        'roles' => ['admin', 'manager'],
                    ),
                    array(
                        'title' => 'Countries',
                        'url' => route('dashboard.countries.index'),
                        'roles' => ['admin', 'manager'],
                    ),
                    array(
                        'title' => 'Travel Directions',
                        'url' => route('dashboard.directions.index'),
                        'roles' => ['admin', 'manager'],
                    ),
                ),
            ),
            array(
                'title' => 'Settings',
                'url' => route('dashboard.settings.index'),
                'icon' => 'ki-element-11',
                'roles' => ['admin'],
                'childs' => array(
                    array(
                        'title' => 'General',
                        'url' => route('dashboard.settings.index'),
                        'roles' => ['admin'],
                    ),
                    array(
                        'title' => 'Users',
                        'url' => route('dashboard.users.index'),
                        'roles' => ['admin'],
                    ),
                ),

            ),
            array(
                'title' => 'My cabinet',
                'url' => '',
                'icon' => 'ki-user',
                'roles' => ['user'],
                'childs' => array(
                    array(
                        'title' => 'Profile',
                        'url' => route('dashboard.profile'),
                        'roles' => ['user'],
                    ),
                    array(
                        'title' => 'Orders',
                        'url' => route('dashboard.my-orders'),
                        'roles' => ['user'],
                    ),
                ),
            ),
        );

    }

}