<?php
// app/Helpers/MenuHelper.php

namespace App\Helpers;

class MenuHelper
{
    /**
     * Mengembalikan daftar menu grup untuk sidebar admin RS Medika Nusantara.
     */
    public static function getMenuGroups(): array
    {
        return [
            // ── MENU UTAMA ──────────────────────────────────────────
            [
                'title' => 'Menu Utama',
                'items' => [
                    [
                        'name' => 'Dashboard',
                        'icon' => 'grid',
                        'path' => '/admin',
                    ],
                ],
            ],

            // ── KONTEN ───────────────────────────────────────────────
            [
                'title' => 'Manajemen Konten',
                'items' => [
                    [
                        'name'     => 'Artikel & Berita',
                        'icon'     => 'file-text',
                        'path'     => '#',
                        'subItems' => [
                            ['name' => 'Semua Artikel', 'path' => '/admin/articles'],
                            ['name' => 'Tambah Artikel', 'path' => '/admin/articles/create'],
                        ],
                    ],
                    [
                        'name'     => 'Edukasi Kesehatan',
                        'icon'     => 'book-open',
                        'path'     => '#',
                        'subItems' => [
                            ['name' => 'Semua Edukasi', 'path' => '/admin/educations'],
                            ['name' => 'Tambah Edukasi', 'path' => '/admin/educations/create'],
                        ],
                    ],
                ],
            ],

            // ── LAYANAN & DOKTER ──────────────────────────────────────
            [
                'title' => 'Layanan Medis',
                'items' => [
                    [
                        'name'     => 'Layanan RS',
                        'icon'     => 'hospital',
                        'path'     => '#',
                        'subItems' => [
                            ['name' => 'Semua Layanan', 'path' => '/admin/services'],
                            ['name' => 'Tambah Layanan', 'path' => '/admin/services/create'],
                        ],
                    ],
                    [
                        'name'     => 'Dokter',
                        'icon'     => 'user-md',
                        'path'     => '#',
                        'subItems' => [
                            ['name' => 'Semua Dokter',  'path' => '/admin/doctors'],
                            ['name' => 'Tambah Dokter', 'path' => '/admin/doctors/create'],
                        ],
                    ],
                    [
                        'name'     => 'Jadwal Praktik',
                        'icon'     => 'calendar',
                        'path'     => '#',
                        'subItems' => [
                            ['name' => 'Semua Jadwal',  'path' => '/admin/schedules'],
                            ['name' => 'Tambah Jadwal', 'path' => '/admin/schedules/create'],
                        ],
                    ],
                ],
            ],

            // ── KOMUNIKASI ────────────────────────────────────────────
            [
                'title' => 'Komunikasi',
                'items' => [
                    [
                        'name' => 'Pesan Masuk',
                        'icon' => 'mail',
                        'path' => '/admin/contacts',
                    ],
                ],
            ],

            // ── PENGATURAN ────────────────────────────────────────────
            [
                'title' => 'Pengaturan',
                'items' => [
                    [
                        'name' => 'Manajemen User',
                        'icon' => 'users',
                        'path' => '/admin/users',
                    ],
                    [
                        'name' => 'Manajemen Rumah sakit',
                        'icon' => 'users',
                        'path' => '/admin/site-settings',
                    ],
                    [
                        'name' => 'Manajemen slider',
                        'icon' => 'users',
                        'path' => '/admin/site-settings',
                    ],
                    [
                        'name' => 'Lihat Website',
                        'icon' => 'external-link',
                        'path' => '/',
                    ],
                ],
            ],
        ];
    }

    /**
     * Mengembalikan SVG icon berdasarkan nama.
     */
    public static function getIconSvg(string $icon): string
    {
        $icons = [
            'grid' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>',

            'file-text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>',

            'book-open' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>',

            'hospital' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>',

            'user-md' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>',

            'calendar' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>',

            'mail' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>',

            'users' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',

            'external-link' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>',
        ];

        return $icons[$icon] ?? '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>';
    }
}
