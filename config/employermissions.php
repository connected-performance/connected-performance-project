<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Permissions
    |--------------------------------------------------------------------------
    */

    // Dashboard Module
        'access_backend' => [
                'display_name' => 'dashboard',
                'category'     => 'Dashboard',
        ],
        // Form Builder Module
        'view_form'  => [
                'display_name' => 'read',
                'category'     => 'Form Builder',
        ],

        'create_from' => [
                'display_name' => 'create',
                'category'     => 'Form Builder',
        ],

        'edit_from' => [
                'display_name' => 'update',
                'category'     => 'Form Builder',
        ],
        'delete_from' => [
                'display_name' => 'delete',
                'category'     => 'Form Builder',
        ],
        'link_from' => [
                'display_name' => 'copy from link',
                'category'     => 'Form Builder',
        ],
        'view_response_from' => [
                'display_name' => 'view form response',
                'category'     => 'Form Builder',
        ],

        'view_form_fields'  => [
                'display_name' => 'read',
                'category'     => 'Form Fields',
        ],

        'create_form_fields' => [
                'display_name' => 'create',
                'category'     => 'Form Fields',
        ],

        'edit_form_fields' => [
                'display_name' => 'update',
                'category'     => 'Form Fields',
        ],

        'delete_form_fields' => [
                'display_name' => 'delete',
                'category'     => 'Form Fields',
        ],


        // Customer
        'view_customer'  => [
                'display_name' => 'read',
                'category'     => 'Customer',
        ],
        // Referrals
        'view_referrals'  => [
                'display_name' => 'read',
                'category'     => 'Refferals',
        ],

        'view_referrals' => [
                'display_name' => 'create',
                'category'     => 'Refferals',
        ],

        'view_referrals' => [
                'display_name' => 'update',
                'category'     => 'Refferals',
        ],
        'view_referrals' => [
                'display_name' => 'delete',
                'category'     => 'Refferals',
        ],
        'view_deals' => [
                'display_name' => 'deals',
                'category'     => 'Defferals',
        ],
        'view_payments' => [
                'display_name' => 'payments',
                'category'     => 'Payments',
        ],

        // Invoice Module
        'view_invoice' => [
                'display_name' => 'read',
                'category'     => 'Invoice',
        ],
        'create_invoice' => [
                'display_name' => 'create',
                'category'     => 'Invoice',
        ],

        'edit_invoice' => [
                'display_name' => 'update',
                'category'     => 'Invoice',
        ],

        'delete_invoice' => [
                'display_name' => 'delete',
                'category'     => 'Invoice',
        ],

        // Lead Module
        'view_lead' => [
                'display_name' => 'lead',
                'category'     => 'Lead',
        ],


        //Sen Mail
        'send-mail' => [
                'display_name' => 'Send Mail',
                'category' => 'Send Mail',
        ]
];
