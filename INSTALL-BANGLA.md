# MRH License Package — ইনস্টল গাইড (বাংলা)

সম্পূর্ণ ও কার্যকর লাইসেন্স প্যাকেজ। পোর্টফোলিও (বা যেকোনো Laravel) প্রজেক্টে
ক্লায়েন্ট-সাইড লাইসেন্স যাচাই যোগ করে।

## ধাপ ০ — প্যাকেজ রাখুন
এই ফোল্ডারটি রাখুন: `your-project/packages/mrh-license`

## ধাপ ১ — root composer.json এ path repository
```json
"repositories": [
    { "type": "path", "url": "packages/mrh-license", "options": { "symlink": true } }
]
```
> Windows/Laragon এ symlink সমস্যা করলে `"symlink": false` দিন।

## ধাপ ২ — .env এ কনফিগ (গুরুত্বপূর্ণ!)
```
# লাইসেন্স সার্ভারের ঠিকানা — এটি APP_URL থেকে আলাদা!
MRH_LICENSE_SERVER_URL=http://127.0.0.1:8000
MRH_LICENSE_CACHE_TTL=24
MRH_LICENSE_GRACE_DAYS=7
MRH_LICENSE_GUARD_ENABLED=true
MRH_LICENSE_INSTALL_WIZARD=true

# ঐচ্ছিক: server type জোর করে সেট করতে (auto-detect bypass)
# .test/.local ডোমেইনে দরকার হলে:
# MRH_LICENSE_SERVER_TYPE=domain
```

⚠️ **সবচেয়ে সাধারণ ভুল:** `MRH_LICENSE_SERVER_URL` আর `APP_URL` গুলিয়ে ফেলা।
- `APP_URL` = আপনার সাইটের ঠিকানা (যেমন http://portfolio-cms.test)
- `MRH_LICENSE_SERVER_URL` = লাইসেন্স সার্ভারের ঠিকানা (যেমন http://127.0.0.1:8000)
এই দুটো অবশ্যই আলাদা। গুলিয়ে গেলে "HTTP 404 route not found" আসবে।

## ধাপ ৩ — ইনস্টল কমান্ড
```bash
composer require mrh/license:dev-main
composer dump-autoload
php artisan migrate
php artisan vendor:publish --tag=mrh-license-key
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
```

## ধাপ ৪ — RSA পাবলিক কি
এই প্যাকেজের `resources/keys/public.pem` অবশ্যই আপনার লাইসেন্স সার্ভারের
`storage/keys/public.pem` এর হুবহু কপি হতে হবে (একই কি-জোড়া)। না মিললে
signature যাচাই ফেল করবে।

## ধাপ ৫ — সার্ভারে লাইসেন্স তৈরি (সঠিক টাইপ)
সাইট কোন ঠিকানায় খুলছেন তার উপর license type নির্ভর করে:
- সাইট `.test`/`.local` বা যেকোনো ডোমেইনে → license **Domain** টাইপ
- সাইট সরাসরি `localhost`/`127.0.0.1` তে → license **Localhost** টাইপ

activation পেজে "Server type detected:" যা দেখায়, license টাইপ তার সাথে মিলতে হবে।

## ধাপ ৬ — activate
সার্ভার চালু রেখে (127.0.0.1:8000) সাইটে গিয়ে key বসিয়ে Activate চাপুন।
সঠিক হলে হোমপেজে redirect হবে।

CLI দিয়েও করা যায়:
```bash
php artisan mrh-license:activate --key=XXXX-XXXX-XXXX-XXXX
php artisan mrh-license:status
php artisan mrh-license:logs          # ডিবাগের জন্য লগ দেখা
php artisan mrh-license:verify --force
php artisan mrh-license:reset --force
```

## ধাপ ৭ — দৈনিক verify (অটো)
activate এর পর প্রতি পেজ লোডে সার্ভারে যায় না — ২৪ ঘণ্টা পর দৈনিক verify তে যায়।
অটো চলাতে সার্ভারে cron:
```
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
```

## সাধারণ সমস্যা ও সমাধান
- **HTTP 404 route not found** → MRH_LICENSE_SERVER_URL ভুল (APP_URL হয়ে গেছে)। ঠিক করে `config:clear`।
- **Server environment not permitted** → license type আর detected server type মেলে না। license type ঠিক করুন, বা `MRH_LICENSE_SERVER_TYPE` দিন।
- **Localhost licenses cannot be used on public domain** → license Localhost কিন্তু সাইট ডোমেইনে। license Domain করুন।
- **Maximum activations reached** → সার্ভারে license reset করে slot খালি করুন (নীল Reset বাটন)।
- **This license has expired** → সার্ভারে expiry ভবিষ্যতের তারিখ দিন।
- **activation পেজে server type ভুল দেখায়** → cache: `php artisan optimize:clear && php artisan config:clear`। vendor পুরনো হলে `rm -rf vendor/mrh && composer require mrh/license:dev-main`।
- **ফর্ম submit করলে কিছু হয় না** → route cache পুরনো: `php artisan route:clear`।
