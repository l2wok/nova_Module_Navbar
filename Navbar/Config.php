<?php

use Core\Config;

Config::set('navbar', [
    "class" => "navbar-default",
    "brand" => [
        "href" => "/",
        "name" => "<i class='fa fa-home'></i>"
    ],
    "first" => [
        [
            "href" => "subpage",
            "name" => "Subpage"
        ],
//        [
//            "href" => "blog",
//            "name" => "Blog"
//        ],
//        [
//            "href"   => "teamspeak",
//            "name"   => "Teamspeak",
//            "childs" => [
//                [
//                    "href" => "about",
//                    "name" => "About ts3",
//                ],
//                [
//                    "href" => "getkey",
//                    "name" => "Get access",
//                ],
//                [
//                    "divider" => true,
//                    "onlogin" => true
//                ],
//                [
//                    "href"    => "history",
//                    "name"    => "Key history",
//                    "onlogin" => true
//                ],
//            ]
//        ],
    ],
    "last"  => [
        "language" => true,
        [
            "href"    => "oauth",
            "name"    => "Enter",
            "onlogin" => false
        ],
        [
            "href"    => "profile",
            "name"    => "Profile",
            "onlogin" => true
        ],
        [
            "href"    => "logout",
            "name"    => "Exit",
            "onlogin" => true
        ]
    ],
]);
