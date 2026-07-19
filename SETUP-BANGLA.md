# mrh-license — সেটআপ গাইড (বাংলা)

এই প্যাকেজটি সম্পূর্ণ ও কার্যকর। সব খালি স্টাব (Transport, Activation, Verification,
Environment resolver, Guard, Console command) ভরাট করা হয়েছে এবং RSA পাবলিক কি
বসানো আছে। নিচের ধাপে পোর্টফোলিও প্রজেক্টে বসিয়ে সেটআপ করুন।

## ০) আগে নিশ্চিত করুন — সার্ভারের কি

লাইসেন্স সার্ভারের `storage/keys/` এ যে `private.pem`/`public.pem` জোড়া আছে,
এই প্যাকেজের `resources/keys/public.pem` অবশ্যই সেই **একই জোড়ার public key**
হতে হবে। আপনি ইতিমধ্যে সার্ভারে কি বসিয়েছেন — তাই সার্ভারের ঐ `public.pem`
এর হুবহু কপি এই প্যাকেজের `resources/keys/public.pem` এ থাকা চাই।

> এই জিপে যে public.pem আছে সেটি একটি নতুন তৈরি করা কি। যদি আপনার সার্ভারে
> ভিন্ন কি বসানো থাকে, তবে সার্ভারের public.pem দিয়ে এই ফাইলটি রিপ্লেস করুন,
> নইলে signature যাচাই ফেল করবে (502/SIGNATURE_INVALID)।

## ১) প্যাকেজ বসান

পুরো `mrh-license` ফোল্ডারটি রাখুন: `portfolio-cms/packages/mrh-license`

## ২) root composer.json এ path repository

```json
"repositories": [
    { "type": "path", "url": "packages/mrh-license", "options": { "symlink": true } }
]
```

## ৩) .env এ কনফিগ

```
MRH_LICENSE_SERVER_URL=http://127.0.0.1:8000
MRH_LICENSE_CACHE_TTL=24
MRH_LICENSE_GRACE_DAYS=7

# গার্ড ও উইজার্ড
MRH_LICENSE_GUARD_ENABLED=true
MRH_LICENSE_INSTALL_WIZARD=true

# ঐচ্ছিক: CLI দিয়ে activate করতে চাইলে কি এখানে রাখুন
# MRH_LICENSE_KEY=XXXX-XXXX-XXXX-XXXX
```

> নোট: URL এর শেষে `/` দেবেন না।

## ৪) কমান্ড চালান

```bash
composer require mrh/license:dev-main
composer dump-autoload
php artisan migrate
php artisan optimize:clear
php artisan config:clear

# পাবলিক কি host অ্যাপে publish করতে চাইলে (ঐচ্ছিক — না করলেও bundled key দিয়ে চলবে)
php artisan vendor:publish --tag=mrh-license-key
```

## ৫) সার্ভারে লাইসেন্স তৈরি (সঠিকভাবে)

localhost এ টেস্ট করছেন, তাই সার্ভার অ্যাডমিনে লাইসেন্স বানানোর সময়:

- server type এ **localhost** অ্যালাউ করুন,
- ডোমেইন লক দিলে **127.0.0.1 / localhost** দিন, নাহলে ডোমেইন লক খালি রাখুন।

না মিললে activate এ এরর আসবে (নিচে দেখুন)।

## ৬) টেস্ট

সার্ভার চালু: `php artisan serve` (127.0.0.1:8000)।
পোর্টফোলিও সাইট খুলুন → লাইসেন্স পেজে কি বসান।

- ভুল কি → লাল বক্সে সার্ভারের এরর মেসেজ।
- সঠিক কি → activate হয়ে সাইট চালু; সার্ভারের `license_activations` টেবিলে নতুন রো।

CLI দিয়েও করা যায়:

```bash
php artisan mrh-license:activate --key=XXXX-XXXX-XXXX-XXXX
php artisan mrh-license:status
php artisan mrh-license:verify --force
php artisan mrh-license:reset
```

## ৭) দৈনিক verify (অটো)

activate এর পর প্রতি পেজ লোডে সার্ভারে যায় না — শুধু ২৪ ঘণ্টা পর দৈনিক verify তে যায়।
অটো চলার জন্য সার্ভারে cron বসান:

```
* * * * * cd /path-to-portfolio-cms && php artisan schedule:run >> /dev/null 2>&1
```

## সাধারণ এরর ও অর্থ

- `SERVER_TYPE_NOT_ALLOWED` → লাইসেন্স localhost অ্যালাউ করছে না (ধাপ ৫)।
- `DOMAIN_MISMATCH` / `DOMAIN_LOCKED` → ডোমেইন লক localhost এর সাথে মিলছে না।
- `LICENSE_NOT_FOUND` → কি ভুল।
- `ACTIVATION_LIMIT_REACHED` → ঐ লাইসেন্সের activation স্লট শেষ।
- signature/502 এরর → সার্ভার আর ক্লায়েন্টের কি একই জোড়ার নয় (ধাপ ০)।

## ডিবাগ

```bash
php artisan tinker
>>> \Mrh\License\Models\LicenseLog::latest()->take(5)->get(['channel','event','message']);
```
