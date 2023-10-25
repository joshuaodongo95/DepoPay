<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subscription;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'           => 'Subscriptions',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Subscription',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_period'         => 'year',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'w-full lg:w-6/12 xl:w-3/12',
            'entries_number'        => '10',
            'translation_key'       => 'subscription',
        ];

        $chart1 = new LaravelChart($settings1);

        $settings2 = [
            'chart_title'           => 'Subscriptions',
            'chart_type'            => 'bar',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Subscription',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_period'         => 'year',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'w-full lg:w-6/12 xl:w-3/12',
            'entries_number'        => '5',
            'translation_key'       => 'subscription',
        ];

        $chart2 = new LaravelChart($settings2);

        $settings3 = [
            'chart_title'           => 'Latest Transactions',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Subscription',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_period'         => 'year',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'w-full',
            'entries_number'        => '10',
            'fields'                => [
                'id'           => '',
                'ref'          => '',
                'customer'     => 'name',
                'product'      => 'name',
                'payment_plan' => 'name',
                'status'       => '',
            ],
            'translation_key' => 'subscription',
        ];

        $settings3['data'] = [];
        if (class_exists($settings3['model'])) {
            $settings3['data'] = $settings3['model']::latest()
                ->take($settings3['entries_number'])
                ->get();
        }

        if (! array_key_exists('fields', $settings3)) {
            $settings3['fields'] = [];
        }

        return view('admin.home', compact('chart1', 'chart2', 'settings3'));
    }

    public function user()
    {
        $settings1 = [
            'chart_title'           => 'Subscriptions',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Subscription',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_period'         => 'year',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'w-full lg:w-6/12 xl:w-3/12',
            'entries_number'        => '10',
            'translation_key'       => 'subscription',
        ];

        $chart1 = new LaravelChart($settings1);

        $settings2 = [
            'chart_title'           => 'Subscriptions',
            'chart_type'            => 'bar',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Subscription',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_period'         => 'year',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'w-full lg:w-6/12 xl:w-3/12',
            'entries_number'        => '5',
            'translation_key'       => 'subscription',
        ];

        $chart2 = new LaravelChart($settings2);

        $settings3 = [
            'chart_title'           => 'Latest Transactions',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Subscription',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_period'         => 'year',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class'          => 'w-full',
            'entries_number'        => '10',
            'fields'                => [
                'id'           => '',
                'ref'          => '',
                'customer'     => 'name',
                'product'      => 'name',
                'payment_plan' => 'name',
                'status'       => '',
            ],
            'translation_key' => 'subscription',
        ];

        $settings3['data'] = [];
        if (class_exists($settings3['model'])) {
            $settings3['data'] = $settings3['model']::latest()
                ->take($settings3['entries_number'])
                ->get();
        }

        if (! array_key_exists('fields', $settings3)) {
            $settings3['fields'] = [];
        }
        return view('user.admin', compact('chart1', 'chart2', 'settings3'));

    }
}
