<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Footer extends Component
{
    public $platformName;
    public $description;
    public $socialLinks;
    public $phone;
    public $email;
    public $designerName;
    public $designerLink;
    public $badges;
    public $footerLinks;

    public function __construct(
        $platformName = null,
        $description = null,
        $socialLinks = null,
        $phone = null,
        $email = null,
        $designerName = null,
        $designerLink = null,
        $badges = null,
        $footerLinks = 'main'
    ) {
        $this->platformName = $platformName ?? '(اسم المنصة)';
        $this->description = $description ?? 'منصة تعليمية متكاملة تخدم طلاب المرحلتين الإعدادية والثانوية بمختلف أنظمتها التعليمية.';
        $this->socialLinks = $socialLinks ?? [];
        $this->phone = $phone ?? '201557582785';
        $this->email = $email ?? 'info@al-azhari.edu';
        $this->designerName = $designerName ?? 'عمر عنوس';
        $this->designerLink = $designerLink ?? 'https://omaranos517.vercel.app';
        $this->badges = $badges ?? [
            ['icon'=>'lock','text'=>'آمن ومحمي'],
            ['icon'=>'certificate','text'=>'جودة عالية'],
            ['icon'=>'users','text'=>'مجتمع نشط'],
        ];
        $this->footerLinks = $footerLinks;
    }

    public function render()
    {
        return view('components.footer');
    }
}
