<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\CustomPageController as AdminCustomPageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\CacheController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\NewsletterCampaignController;
use App\Http\Controllers\Admin\PricingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\ResumeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\SubscriberController as AdminSubscriberController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\FrontendLoginController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\BlogCategoryController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\CustomPageController;
use App\Http\Controllers\Front\UserDashboardController;
use App\Http\Controllers\Front\FaqController as FrontFaqController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PricingController as FrontPricingController;
use App\Http\Controllers\Front\ProjectController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\RobotsTxtController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Front-End (Public) Routes
|--------------------------------------------------------------------------
*/

// Language Switch
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

// Sitemap (Public)
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

// Robots.txt (Public)
Route::get('/robots.txt', [RobotsTxtController::class, 'index']);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [\App\Http\Controllers\Front\AboutController::class, 'index'])->name('about');
Route::get('/portfolio.pdf', [\App\Http\Controllers\Front\PortfolioExportController::class, 'export'])->name('portfolio.pdf');
Route::get('/portfolio-preview', [\App\Http\Controllers\Front\PortfolioExportController::class, 'preview'])->name('portfolio.preview');
Route::get('/services', [\App\Http\Controllers\Front\ServiceController::class, 'index'])->name('services');
Route::get('/services/{service:slug}', [\App\Http\Controllers\Front\ServiceController::class, 'show'])->name('services.show');
Route::get('/quote', [App\Http\Controllers\Front\ServiceRequestController::class, 'create'])->name('quote');
Route::post('/quote', [App\Http\Controllers\Front\ServiceRequestController::class, 'store'])->name('quote.store')->middleware('throttle:3,60');

Route::prefix('portfolio')->name('projects.')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('index');
    Route::get('/{project:slug}', [ProjectController::class, 'show'])->name('show');
    Route::get('/{project:slug}/download', [ProjectController::class, 'download'])->name('download');
});

Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/categories', [BlogCategoryController::class, 'index'])->name('categories');
    Route::get('/categories/{category:slug}', [BlogCategoryController::class, 'show'])->name('category');
    Route::get('/{blog:slug}', [BlogController::class, 'show'])->name('show');
    Route::post('/{blog:slug}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('throttle:5,60');
});

Route::prefix('admin/comments')->name('admin.comments.')->group(function () {
    Route::get('/', [CommentController::class, 'index'])->name('index');
    Route::post('/{comment}/approve', [CommentController::class, 'approve'])->name('approve');
    Route::post('/{comment}/reject', [CommentController::class, 'reject'])->name('reject');
    Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('destroy');
});

Route::get('/contact', [\App\Http\Controllers\Front\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store')->middleware('throttle:3,60');
Route::get('/thank-you', function () {
    return view('front.thank-you');
})->name('thank-you');

/*
|--------------------------------------------------------------------------
| User Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [FrontendLoginController::class, 'showLoginForm'])->name('user.login');
    Route::post('/login', [FrontendLoginController::class, 'login'])->name('user.login.submit');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('user.register');
    Route::post('/register', [RegisterController::class, 'register'])->name('user.register');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/profile', [UserDashboardController::class, 'profile'])->name('user.profile');
    Route::put('/profile', [UserDashboardController::class, 'updateProfile'])->name('user.profile.update');
    Route::put('/password', [UserDashboardController::class, 'updatePassword'])->name('user.password.update');
    Route::post('/logout', [FrontendLoginController::class, 'logout'])->name('user.logout');
});

/*
|--------------------------------------------------------------------------
| Client Portal Routes
|--------------------------------------------------------------------------
*/

Route::get('/client-portal/access', [App\Http\Controllers\Front\ClientPortalAccessController::class, 'access'])->name('client-portal.access');
Route::post('/client-portal/verify', [App\Http\Controllers\Front\ClientPortalAccessController::class, 'verify'])->name('client-portal.verify');
Route::middleware('web')->group(function () {
    Route::get('/client-portal/dashboard', [App\Http\Controllers\Front\ClientPortalAccessController::class, 'dashboard'])->name('client-portal.dashboard');
    Route::post('/client-portal/logout', [App\Http\Controllers\Front\ClientPortalAccessController::class, 'logout'])->name('client-portal.logout');
});

Route::get('/coming-soon', function () {
    return view('front.coming-soon');
})->name('coming-soon');
Route::get('/faq', [FrontFaqController::class, 'index'])->name('faq');
Route::get('/pricing', [FrontPricingController::class, 'index'])->name('pricing');
Route::get('/privacy', function () { return view('front.privacy'); })->name('privacy');

// Cookie Consent
Route::post('/cookie/accept', [App\Http\Controllers\Front\CookieController::class, 'accept'])->name('cookie.accept');
Route::post('/cookie/decline', [App\Http\Controllers\Front\CookieController::class, 'decline'])->name('cookie.decline');
Route::get('/terms', function () { return view('front.terms'); })->name('terms');
Route::get('/resume', [\App\Http\Controllers\Front\ResumeController::class, 'index'])->name('resume');
Route::get('/resume/preview', [\App\Http\Controllers\Front\ResumeController::class, 'preview'])->name('resume.preview');
Route::get('/search', [\App\Http\Controllers\Front\SearchController::class, 'search'])->name('search');
Route::post('/subscribe', [\App\Http\Controllers\SubscriberController::class, 'store'])->name('subscribe.store')->middleware('throttle:2,60');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    // GET /login - shows form (or redirects to dashboard if already logged in)
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    // POST /login - validates credentials (only for guests)
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit')->middleware('guest');

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Panel Routes (Protected)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // About
    Route::get('/about', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('/about', [AboutController::class, 'update'])->name('about.update');

    // Skills
    Route::resource('skills', SkillController::class)->except(['show']);

    // Services
    Route::resource('services', AdminServiceController::class)->except(['show']);

    // Service Requests
    Route::get('/service-requests', [App\Http\Controllers\Admin\ServiceRequestController::class, 'index'])->name('service-requests.index');
    Route::get('/service-requests/{request}', [App\Http\Controllers\Admin\ServiceRequestController::class, 'show'])->name('service-requests.show');
    Route::post('/service-requests/{request}/status', [App\Http\Controllers\Admin\ServiceRequestController::class, 'updateStatus'])->name('service-requests.status');
    Route::delete('/service-requests/{request}', [App\Http\Controllers\Admin\ServiceRequestController::class, 'destroy'])->name('service-requests.destroy');

    // Media Library
    Route::get('/media', [MediaController::class, 'index'])->name('media.index');
    Route::post('/media/upload', [MediaController::class, 'upload'])->name('media.upload');
    Route::put('/media/{media}', [MediaController::class, 'update'])->name('media.update');
    Route::delete('/media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');

    // Cache Management
    Route::post('/cache/clear', [CacheController::class, 'clear'])->name('cache.clear');
    Route::post('/cache/optimize', [CacheController::class, 'optimize'])->name('cache.optimize');

    // Menu Builder
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
    Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
    Route::put('/menu/{menu}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/menu/{menu}', [MenuController::class, 'destroy'])->name('menu.destroy');
    Route::post('/menu/reorder', [MenuController::class, 'reorder'])->name('menu.reorder');

    // Experience
    Route::resource('experience', ExperienceController::class)->except(['show']);

    // Education
    Route::resource('education', EducationController::class)->except(['show']);

    // Projects
    Route::get('/projects/categories', [AdminProjectController::class, 'categories'])->name('projects.categories');
    Route::post('/projects/categories', [AdminProjectController::class, 'storeCategory'])->name('projects.categories.store');
    Route::delete('/projects/categories/{category}', [AdminProjectController::class, 'destroyCategory'])->name('projects.categories.destroy');
    Route::delete('/projects/gallery/{gallery}', [AdminProjectController::class, 'destroyGalleryImage'])->name('projects.gallery.destroy');
    Route::resource('projects', AdminProjectController::class)->except(['show']);

    // Blog
    Route::get('/blog/categories', [AdminBlogController::class, 'categories'])->name('blog.categories');
    Route::post('/blog/categories', [AdminBlogController::class, 'storeCategory'])->name('blog.categories.store');
    Route::delete('/blog/categories/{category}', [AdminBlogController::class, 'destroyCategory'])->name('blog.categories.destroy');
    Route::resource('blog', AdminBlogController::class)->except(['show']);

    // Testimonials
    Route::resource('testimonials', AdminTestimonialController::class)->except(['show']);

    // Contact Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::put('/messages/{message}/read', [MessageController::class, 'markRead'])->name('messages.read');
    Route::put('/messages/{message}/unread', [MessageController::class, 'markUnread'])->name('messages.unread');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    // Site Settings
    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::post('/settings/test-mail', [SettingController::class, 'testMail'])->name('settings.testMail');

    // Menu Builder
    Route::get('/menu-builder', [App\Http\Controllers\Admin\MenuBuilderController::class, 'index'])->name('menu-builder.index');
    Route::post('/menu-builder', [App\Http\Controllers\Admin\MenuBuilderController::class, 'store'])->name('menu-builder.store');
    Route::put('/menu-builder/{menuItem}', [App\Http\Controllers\Admin\MenuBuilderController::class, 'update'])->name('menu-builder.update');
    Route::delete('/menu-builder/{menuItem}', [App\Http\Controllers\Admin\MenuBuilderController::class, 'destroy'])->name('menu-builder.destroy');
    Route::post('/menu-builder/reorder', [App\Http\Controllers\Admin\MenuBuilderController::class, 'reorder'])->name('menu-builder.reorder');
    Route::post('/menu-builder/{menuItem}/toggle', [App\Http\Controllers\Admin\MenuBuilderController::class, 'toggle'])->name('menu-builder.toggle');

    // License information
    Route::get('/license', [\App\Http\Controllers\Admin\LicenseController::class, 'index'])->name('license.index');

    // Analytics
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');

    // SEO Settings
    Route::get('/seo', [SeoController::class, 'edit'])->name('seo.edit');
    Route::put('/seo', [SeoController::class, 'update'])->name('seo.update');

    // Content Settings
    Route::get('/content', [\App\Http\Controllers\Admin\ContentController::class, 'index'])->name('content.index');
    Route::post('/content', [\App\Http\Controllers\Admin\ContentController::class, 'update'])->name('content.update');
    Route::get('/content/reset', [\App\Http\Controllers\Admin\ContentController::class, 'reset'])->name('content.reset');

    // Users & Roles
    Route::resource('users', UserController::class)->except(['show']);
    Route::get('users/{user}/export', [UserController::class, 'exportData'])->name('users.export');
    Route::post('users/bulk-delete', [UserController::class, 'bulkDestroy'])->name('users.bulk-destroy');
    Route::resource('roles', RoleController::class)->except(['show']);
    
    // FAQs
    Route::resource('faqs', FaqController::class)->except(['show']);
    
    // Pricing Plans
    Route::resource('pricing', PricingController::class)->except(['show']);
    
    // Resume Builder
    Route::get('/resume', [ResumeController::class, 'index'])->name('resume.index');
    Route::put('/resume', [ResumeController::class, 'update'])->name('resume.update');
    Route::get('/resume/preview', [ResumeController::class, 'preview'])->name('resume.preview');
    Route::get('/resume/download', [ResumeController::class, 'download'])->name('resume.download');
    
    // Newsletter Campaigns
    Route::resource('newsletter', NewsletterCampaignController::class);
    
    // Tags
    Route::resource('tags', TagController::class);
    
    // Statistics
    Route::resource('statistics', StatisticController::class);
    
    // Certifications
    Route::resource('certifications', CertificationController::class);
    
    // Subscribers
    Route::get('/subscribers', [AdminSubscriberController::class, 'index'])->name('subscribers.index');
    Route::delete('/subscribers/{subscriber}', [AdminSubscriberController::class, 'destroy'])->name('subscribers.destroy');

    // Client Portals
    Route::get('/client-portals', [App\Http\Controllers\Admin\ClientPortalController::class, 'index'])->name('client-portals.index');
    Route::get('/client-portals/create', [App\Http\Controllers\Admin\ClientPortalController::class, 'create'])->name('client-portals.create');
    Route::post('/client-portals', [App\Http\Controllers\Admin\ClientPortalController::class, 'store'])->name('client-portals.store');
    Route::get('/client-portals/{clientPortal}', [App\Http\Controllers\Admin\ClientPortalController::class, 'show'])->name('client-portals.show');
    Route::get('/client-portals/{clientPortal}/edit', [App\Http\Controllers\Admin\ClientPortalController::class, 'edit'])->name('client-portals.edit');
    Route::put('/client-portals/{clientPortal}', [App\Http\Controllers\Admin\ClientPortalController::class, 'update'])->name('client-portals.update');
    Route::delete('/client-portals/{clientPortal}', [App\Http\Controllers\Admin\ClientPortalController::class, 'destroy'])->name('client-portals.destroy');
    Route::post('/client-portals/{clientPortal}/add-file', [App\Http\Controllers\Admin\ClientPortalController::class, 'addFile'])->name('client-portals.add-file');
    Route::post('/client-portals/{clientPortal}/regenerate-token', [App\Http\Controllers\Admin\ClientPortalController::class, 'generateToken'])->name('client-portals.regenerate-token');
    Route::get('/subscribers/export', [AdminSubscriberController::class, 'export'])->name('subscribers.export');
    
    // Custom Pages (Admin only - for CRUD)
    Route::resource('custom-pages', AdminCustomPageController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
});

// Custom Pages (Public - for viewing)
Route::get('/{page:slug}', [CustomPageController::class, 'show'])->name('page.show');

/*
|--------------------------------------------------------------------------
| Laravel File Manager (only if package is installed)
|--------------------------------------------------------------------------
*/

if (class_exists(\UniSharp\LaravelFilemanager\Lfm::class)) {
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth', 'admin']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
}
