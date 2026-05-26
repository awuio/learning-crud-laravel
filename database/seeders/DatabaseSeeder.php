<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Helper to generate extremely long, realistic product marketing copy.
     */
    private function generateDescription(string $name, string $category, string $specs): string
    {
        $intro = "Experience the next level of innovation with the revolutionary {$name}, a premium device crafted by Apple. As a flagship addition to the {$category} lineup, this product is engineered to deliver outstanding performance, unmatched efficiency, and a stunning aesthetic appeal.";
        $middle = "Equipped with state-of-the-art features including {$specs}, this device is optimized to handle intensive workflows, daily productivity, and creative applications with ease. The premium design, combined with Apple's strict attention to detail, ensures maximum reliability.";
        $outro = "Furthermore, it integrates seamlessly into the broader Apple ecosystem, allowing you to sync with your other devices effortlessly. With an excellent battery life, top-tier security, and eco-friendly recycled materials, the {$name} stands as the ultimate choice for users who refuse to compromise on quality and modern capability.";

        return $intro.' '.$middle.' '.$outro;
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Users
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ]
        );

        // 2. Define Apple Product Categories and their respective 10 products
        $appleData = [
            'MacBook' => [
                ['name' => 'MacBook Air 13" M2 (8GB/256GB)', 'specs' => 'an ultra-thin profile, the powerful M2 chip, a brilliant Liquid Retina display, and up to 18 hours of battery life', 'price' => 1099.00],
                ['name' => 'MacBook Air 13" M3 (16GB/512GB)', 'specs' => 'the lightning-fast M3 chip, support for up to two external displays, enhanced Wi-Fi 6E connectivity, and an ultra-portable silent fanless design', 'price' => 1299.00],
                ['name' => 'MacBook Air 15" M3 (8GB/256GB)', 'specs' => 'a spacious 15.3-inch Liquid Retina display, the power of the M3 chip, a six-speaker sound system with Spatial Audio, and a thin fanless design', 'price' => 1299.00],
                ['name' => 'MacBook Pro 14" M3 (8GB/512GB)', 'specs' => 'a 14.2-inch Liquid Retina XDR display, the highly efficient M3 chip, a versatile array of ports including HDMI and SDXC card slots, and high-fidelity sound', 'price' => 1599.00],
                ['name' => 'MacBook Pro 14" M3 Pro (18GB/512GB)', 'specs' => 'the powerhouse M3 Pro chip, up to 36GB of unified memory, advanced thermal systems for sustained performance, and three Thunderbolt 4 ports', 'price' => 1999.00],
                ['name' => 'MacBook Pro 14" M3 Max (36GB/1TB)', 'specs' => 'the extreme M3 Max chip with a 40-core GPU, massive 128GB unified memory support, multiple high-speed ports, and desktop-class graphics performance', 'price' => 3199.00],
                ['name' => 'MacBook Pro 16" M3 Pro (18GB/512GB)', 'specs' => 'a stunning 16.2-inch Liquid Retina XDR display, the supercharged M3 Pro chip, an expansive keyboard, and industry-leading battery life up to 22 hours', 'price' => 2499.00],
                ['name' => 'MacBook Pro 16" M3 Max (36GB/1TB)', 'specs' => 'the top-of-the-line M3 Max chip, an expansive Liquid Retina XDR screen, extraordinary thermal management, and support for multiple high-resolution displays', 'price' => 3499.00],
                ['name' => 'MacBook Air 13" M1 (8GB/256GB)', 'specs' => 'the classic fanless design, the groundbreaking M1 chip, a high-quality Retina display, and an exceptionally tactile Magic Keyboard', 'price' => 899.00],
                ['name' => 'MacBook Pro 13" M2 (8GB/512GB)', 'specs' => 'an active cooling system for sustained performance, the modern M2 chip, the iconic Touch Bar, and a brilliant Retina display', 'price' => 1299.00],
            ],
            'Mac Desktop' => [
                ['name' => 'Mac mini M2 (8GB/256GB)', 'specs' => 'a compact 7.7-inch square design, the incredibly fast M2 chip, advanced thermal design, and a comprehensive selection of connectivity ports', 'price' => 599.00],
                ['name' => 'Mac mini M2 Pro (16GB/512GB)', 'specs' => 'the powerful M2 Pro chip, up to four Thunderbolt 4 ports, support for multiple high-resolution external monitors, and rapid SSD storage', 'price' => 1299.00],
                ['name' => 'Mac Studio M2 Max (32GB/512GB)', 'specs' => 'a powerful M2 Max processor, a highly efficient dual-fan cooling setup, multiple front-facing ports for easy access, and professional-grade performance', 'price' => 1999.00],
                ['name' => 'Mac Studio M2 Ultra (64GB/1TB)', 'specs' => 'the colossal M2 Ultra chip, support for up to eight 4K displays, a vast selection of high-speed Thunderbolt 4 ports, and massive unified memory capability', 'price' => 3999.00],
                ['name' => 'iMac 24" M3 (8GB/256GB, 2-port)', 'specs' => 'a remarkably thin 11.5mm design, the new M3 chip, a breathtaking 4.5K Retina display, and a matching color-coordinated Magic Mouse and Keyboard', 'price' => 1299.00],
                ['name' => 'iMac 24" M3 (16GB/512GB, 4-port)', 'specs' => 'four high-speed USB/Thunderbolt ports, the M3 chip, an exquisite 24-inch 4.5K Retina screen, Gigabit Ethernet, and matching accessories with Touch ID', 'price' => 1699.00],
                ['name' => 'Mac Pro M2 Ultra Rack Mount', 'specs' => 'a specialized rack-mount enclosure, the modular M2 Ultra chip, PCIe Gen 4 expansion slots for custom expansion cards, and professional rack cabinet compatibility', 'price' => 7499.00],
                ['name' => 'Mac Pro M2 Ultra Tower Mount', 'specs' => 'a versatile tower enclosure with easy-access handles, the M2 Ultra chip, extensive PCIe Gen 4 internal expansion, and ultra-quiet cooling fans', 'price' => 6999.00],
                ['name' => 'Mac mini M1 (8GB/256GB)', 'specs' => 'the revolutionary M1 chip, an exceptionally quiet desktop experience, a compact aluminum body, and highly energy-efficient operation', 'price' => 499.00],
                ['name' => 'iMac 27" Intel Core i7 (Retina 5K)', 'specs' => 'a large 27-inch Retina 5K display, a powerful Intel Core i7 processor, dedicated Radeon Pro graphics, and a highly upgradable RAM system', 'price' => 1799.00],
            ],
            'iPad' => [
                ['name' => 'iPad 10.9" 10th Gen (64GB, Wi-Fi)', 'specs' => 'a vibrant 10.9-inch Liquid Retina display, the reliable A14 Bionic chip, an updated landscape front camera, and a convenient USB-C port', 'price' => 349.00],
                ['name' => 'iPad 10.9" 10th Gen (256GB, Cellular)', 'specs' => 'super-fast 5G cellular connectivity, a beautiful all-screen design, A14 Bionic processor, and support for the Magic Keyboard Folio', 'price' => 499.00],
                ['name' => 'iPad mini 6 (64GB, Wi-Fi)', 'specs' => 'an ultra-portable 8.3-inch Liquid Retina display, the powerful A15 Bionic chip, support for Apple Pencil 2, and a sleek all-screen design', 'price' => 499.00],
                ['name' => 'iPad mini 6 (256GB, Cellular)', 'specs' => 'built-in 5G cellular connectivity, an incredibly compact form factor, the A15 Bionic chip, and a high-resolution 12MP Ultra Wide front camera', 'price' => 649.00],
                ['name' => 'iPad Air 11" M2 (128GB, Wi-Fi)', 'specs' => 'the superfast M2 chip, a 11-inch Liquid Retina display, support for Apple Pencil Pro, and high-quality landscape stereo speakers', 'price' => 599.00],
                ['name' => 'iPad Air 13" M2 (256GB, Cellular)', 'specs' => 'an expansive 13-inch Liquid Retina display, the M2 chip, high-speed 5G cellular connectivity, and a landscape 12MP front camera with Center Stage', 'price' => 799.00],
                ['name' => 'iPad Pro 11" M4 (256GB, Wi-Fi)', 'specs' => 'a revolutionary Tandem OLED Ultra Retina XDR display, the next-generation M4 chip, an incredibly thin aluminum enclosure, and pro cameras', 'price' => 999.00],
                ['name' => 'iPad Pro 11" M4 (1TB, Nano-Texture)', 'specs' => 'a high-performance M4 chip, a premium Nano-Texture glass screen to minimize glare, 1TB of ultra-fast storage, and pro workflow capability', 'price' => 1699.00],
                ['name' => 'iPad Pro 13" M4 (512GB, Wi-Fi)', 'specs' => 'a breathtaking 13-inch Tandem OLED Ultra Retina XDR display, the powerhouse M4 chip, pro-level audio, and thin sleek design', 'price' => 1499.00],
                ['name' => 'iPad Pro 13" M4 (2TB, Nano-Texture)', 'specs' => 'an expansive 13-inch Nano-Texture glass screen, the ultimate M4 processor, a massive 2TB SSD, and 5G cellular connectivity', 'price' => 2299.00],
            ],
            'iPhone' => [
                ['name' => 'iPhone 15 128GB', 'specs' => 'the innovative Dynamic Island, a 48MP main camera with 2x Telephoto, a durable color-infused glass design, and a universal USB-C port', 'price' => 799.00],
                ['name' => 'iPhone 15 Plus 256GB', 'specs' => 'a larger 6.7-inch Super Retina XDR display, the Dynamic Island, incredible all-day battery life, and a powerful 48MP main camera', 'price' => 999.00],
                ['name' => 'iPhone 15 Pro 128GB', 'specs' => 'a premium aerospace-grade titanium design, the revolutionary A17 Pro chip, an adjustable Action button, and a pro-level camera system', 'price' => 999.00],
                ['name' => 'iPhone 15 Pro 512GB', 'specs' => '512GB of high-speed storage, a durable titanium frame, the advanced A17 Pro processor, and a highly customizable pro camera setup', 'price' => 1299.00],
                ['name' => 'iPhone 15 Pro Max 256GB', 'specs' => 'a spacious 6.7-inch screen, the flagship A17 Pro chip, a groundbreaking 5x telephoto camera, and exceptional battery endurance', 'price' => 1199.00],
                ['name' => 'iPhone 15 Pro Max 1TB', 'specs' => 'a massive 1TB storage capacity, a robust titanium frame, A17 Pro silicon, 5x optical zoom camera, and elite video recording capabilities', 'price' => 1599.00],
                ['name' => 'iPhone 14 128GB', 'specs' => 'a dual-camera system, the reliable A15 Bionic chip, a bright Super Retina XDR screen, and life-saving Crash Detection features', 'price' => 699.00],
                ['name' => 'iPhone 14 Plus 256GB', 'specs' => 'an expansive 6.7-inch display, remarkable battery performance, the A15 Bionic chip, and advanced action mode video stabilization', 'price' => 899.00],
                ['name' => 'iPhone 13 128GB', 'specs' => 'a beautiful diagonal dual-camera system, the A15 Bionic chip, a durable Ceramic Shield front cover, and great battery life', 'price' => 599.00],
                ['name' => 'iPhone SE 3rd Gen 64GB', 'specs' => 'a classic compact design with a Home button, the modern A15 Bionic chip, a high-quality 12MP camera, and fast 5G cellular', 'price' => 429.00],
            ],
            'Apple Watch' => [
                ['name' => 'Apple Watch SE 40mm GPS', 'specs' => 'a versatile Retina display, essential fitness tracking, heart rate notifications, and life-saving Crash Detection features', 'price' => 249.00],
                ['name' => 'Apple Watch SE 44mm Cellular', 'specs' => 'cellular connectivity to stay connected without a phone, a large 44mm case, sleep tracking, and advanced workout metrics', 'price' => 329.00],
                ['name' => 'Apple Watch Series 9 41mm GPS', 'specs' => 'the bright Always-On Retina display, the powerful S9 SiP chip, a magical double-tap gesture, and comprehensive health monitoring', 'price' => 399.00],
                ['name' => 'Apple Watch Series 9 45mm Cellular', 'specs' => 'an expansive 45mm screen, standalone cellular capabilities, fast charging support, and temperature sensing for cycle tracking', 'price' => 529.00],
                ['name' => 'Apple Watch Ultra 2 49mm Titanium', 'specs' => 'a rugged 49mm titanium case, dual-frequency GPS, a massive 36-hour battery life, and a customizable Action button for athletes', 'price' => 799.00],
                ['name' => 'Apple Watch Series 8 45mm GPS', 'specs' => 'a detailed Always-On Retina display, advanced temperature sensing, sleep stage tracking, and multiple workout modes', 'price' => 349.00],
                ['name' => 'Apple Watch Hermès Series 9 41mm', 'specs' => 'an exclusive Hermès designer watch face, premium leather band options, the S9 SiP processor, and elegant fashion styling', 'price' => 1249.00],
                ['name' => 'Apple Watch Series 9 45mm Stainless Steel', 'specs' => 'a premium stainless steel case, an exceptionally durable sapphire crystal screen, standalone cellular connectivity, and elegant design', 'price' => 749.00],
                ['name' => 'Apple Watch SE 2nd Gen 40mm Cellular', 'specs' => 'built-in cellular capability, modern activity tracking, fall detection, and an exceptionally comfortable sport band', 'price' => 299.00],
                ['name' => 'Apple Watch Ultra 1st Gen 49mm', 'specs' => 'a robust 49mm titanium design, a highly visible 2000-nits display, specialized bands for outdoor endurance, and dual speakers', 'price' => 699.00],
            ],
            'AirPods' => [
                ['name' => 'AirPods 2nd Generation', 'specs' => 'the classic convenient design, easy setup with Apple devices, high-quality audio, and a long-lasting lightning charging case', 'price' => 129.00],
                ['name' => 'AirPods 3rd Gen (Lightning Case)', 'specs' => 'personalized Spatial Audio with dynamic head tracking, a contoured comfortable design, sweat resistance, and a Lightning case', 'price' => 169.00],
                ['name' => 'AirPods 3rd Gen (MagSafe Case)', 'specs' => 'dynamic head tracking Spatial Audio, sweat and water resistance, and a convenient MagSafe compatible wireless charging case', 'price' => 179.00],
                ['name' => 'AirPods Pro 2nd Gen (USB-C)', 'specs' => 'advanced Active Noise Cancellation, Adaptive Audio mode, a comfortable custom fit, and a MagSafe charging case with USB-C', 'price' => 249.00],
                ['name' => 'AirPods Max (Space Gray)', 'specs' => 'a custom acoustic design, high-fidelity audio, industry-leading Active Noise Cancellation, and a luxurious knit-mesh canopy headband', 'price' => 549.00],
                ['name' => 'AirPods Max (Sky Blue)', 'specs' => 'a striking Sky Blue color, high-fidelity overhead sound, personalized Spatial Audio, and beautiful anodized aluminum earcups', 'price' => 549.00],
                ['name' => 'AirPods Pro 1st Generation', 'specs' => 'highly effective Active Noise Cancellation, Transparency mode, three sizes of soft silicone tips, and a wireless charging case', 'price' => 199.00],
                ['name' => 'AirPods Max (Silver)', 'specs' => 'a clean classic silver finish, high-fidelity premium audio, dynamic head tracking, and intuitive controls via the Digital Crown', 'price' => 549.00],
                ['name' => 'AirPods 2nd Gen Wireless Charging', 'specs' => 'a wireless charging case compatible with Qi chargers, crystal clear voice calls, and fast connection switching', 'price' => 159.00],
                ['name' => 'AirPods Pro 2nd Gen (Lightning MagSafe)', 'specs' => 'pro-grade Active Noise Cancellation, high-end acoustic performance, and a MagSafe charging case with a Lightning port', 'price' => 249.00],
            ],
            'TV & Home' => [
                ['name' => 'Apple TV 4K 64GB (Wi-Fi)', 'specs' => 'stunning 4K Dolby Vision, a powerful A15 Bionic chip, a precise Siri Remote with USB-C, and smooth integration with smart home devices', 'price' => 129.00],
                ['name' => 'Apple TV 4K 128GB (Ethernet)', 'specs' => '128GB of internal storage, a high-speed Gigabit Ethernet port, Thread networking support, and A15 Bionic performance', 'price' => 149.00],
                ['name' => 'HomePod 2nd Generation (Midnight)', 'specs' => 'rich deep bass, high-frequency acoustics, an advanced S7 chip for computational audio, and seamless smart home control', 'price' => 299.00],
                ['name' => 'HomePod 2nd Generation (White)', 'specs' => 'a gorgeous white mesh design, high-fidelity audio, room-sensing technology, and built-in temperature and humidity sensors', 'price' => 299.00],
                ['name' => 'HomePod mini (Space Gray)', 'specs' => 'a compact spherical design, 360-degree room-filling audio, easy Siri voice assistant access, and effortless multi-room audio setup', 'price' => 99.00],
                ['name' => 'HomePod mini (Blue)', 'specs' => 'a bright blue colorway, high-quality computational sound, intercom capability, and simple tap-to-transfer audio', 'price' => 99.00],
                ['name' => 'HomePod mini (Yellow)', 'specs' => 'a vibrant yellow mesh exterior, surprisingly big sound from a small speaker, Siri smart controls, and comprehensive home automation', 'price' => 99.00],
                ['name' => 'HomePod mini (Orange)', 'specs' => 'an eye-catching orange design, impressive full-range driver sound, convenient smart assistant, and family intercom features', 'price' => 99.00],
                ['name' => 'HomePod mini (White)', 'specs' => 'a clean white design, premium multi-room audio, seamless Apple device integration, and a compact space-saving footprint', 'price' => 99.00],
                ['name' => 'Apple TV HD 32GB', 'specs' => 'high-definition 1080p video output, a convenient Siri Remote, access to the App Store, and integration with Apple Arcade', 'price' => 99.00],
            ],
            'Accessories' => [
                ['name' => 'Apple Pencil Pro', 'specs' => 'advanced squeeze and barrel roll gestures, custom haptic feedback, magnetic pairing and charging, and precise pixel-perfect drawings', 'price' => 129.00],
                ['name' => 'Apple Pencil (USB-C)', 'specs' => 'a sliding USB-C port cover, magnetic attachment, low latency, and pixel-perfect precision for iPad users', 'price' => 79.00],
                ['name' => 'Apple Pencil (2nd Generation)', 'specs' => 'wireless magnetic pairing and charging, a double-tap gesture to change tools, and pressure and tilt sensitivity', 'price' => 129.00],
                ['name' => 'Magic Keyboard for iPad Pro 13" (M4)', 'specs' => 'a thin floating cantilever design, a premium aluminum palm rest, an integrated functional glass trackpad, and backlit keys', 'price' => 349.00],
                ['name' => 'Magic Keyboard for iPad Pro 11" (M4)', 'specs' => 'a compact floating design, a smooth glass trackpad with multi-touch support, backlit keys, and excellent typing comfort', 'price' => 299.00],
                ['name' => 'MagSafe Charger (15W)', 'specs' => 'perfect magnetic alignment for fast wireless charging up to 15W, compatibility with Qi chargers, and a durable design', 'price' => 39.00],
                ['name' => 'MagSafe Duo Charger', 'specs' => 'a convenient folding design, simultaneous charging for iPhone and Apple Watch, and a perfect travel-friendly compact size', 'price' => 129.00],
                ['name' => 'Magic Mouse (USB-C)', 'specs' => 'a rechargeable multi-touch surface, a smooth scroll glide, and a high-quality USB-C to Lightning or USB-C cable', 'price' => 79.00],
                ['name' => 'Magic Trackpad (USB-C)', 'specs' => 'a large edge-to-edge glass surface, full support for Multi-Touch gestures, Force Touch technology, and a rechargeable battery', 'price' => 129.00],
                ['name' => 'AirTag (4 Pack)', 'specs' => 'four AirTags to keep track of keys or bags, a simple one-tap setup, built-in speaker, and highly secure Precision Finding', 'price' => 99.00],
            ],
            'Gift Cards & Services' => [
                ['name' => 'Apple Gift Card $25', 'specs' => 'a $25 digital credit code for apps, games, music, movies, and products on the Apple Store and App Store', 'price' => 25.00],
                ['name' => 'Apple Gift Card $50', 'specs' => 'a versatile $50 gift card option, perfect for subscriptions like Apple TV+, Apple Arcade, and iCloud+ storage', 'price' => 50.00],
                ['name' => 'Apple Gift Card $100', 'specs' => 'a $100 digital or physical gift card, ideal for purchasing premium software, accessories, or brand new devices', 'price' => 100.00],
                ['name' => 'Apple Gift Card $200', 'specs' => 'a premium $200 value gift card code, perfect for gifting loved ones towards high-end Apple products', 'price' => 200.00],
                ['name' => 'Apple One Individual 1-Year', 'specs' => 'an all-in-one subscription bundle including Apple Music, Apple TV+, Apple Arcade, and 50GB of iCloud+ storage', 'price' => 179.40],
                ['name' => 'Apple One Family 1-Year', 'specs' => 'a premium family bundle sharing Apple Music, Apple TV+, Apple Arcade, and 200GB of iCloud+ storage for up to 5 members', 'price' => 227.40],
                ['name' => 'Apple Music 12-Month', 'specs' => 'a full year of unlimited access to over 100 million songs, curated playlists, offline listening, and spatial audio', 'price' => 109.90],
                ['name' => 'Apple TV+ 12-Month', 'specs' => 'a 12-month subscription to award-winning Apple Original movies, series, and documentaries with high-quality streaming', 'price' => 99.90],
                ['name' => 'iCloud+ 200GB 1-Year Storage', 'specs' => '200GB of secure cloud storage, HomeKit Secure Video support, Hide My Email features, and advanced iCloud Private Relay', 'price' => 35.88],
                ['name' => 'iCloud+ 2TB 1-Year Storage', 'specs' => 'a massive 2TB of secure cloud storage space, ideal for storing high-resolution photos, 4K videos, and documents safely', 'price' => 119.88],
            ],
            'Apple Vision' => [
                ['name' => 'Apple Vision Pro 256GB', 'specs' => 'a revolutionary spatial computer, ultra-high-resolution dual micro-OLED displays, advanced dual-chip M2 and R1 processors, and intuitive eye and hand tracking', 'price' => 3499.00],
                ['name' => 'Apple Vision Pro 512GB', 'specs' => '512GB of fast onboard storage, immersive spatial audio, real-time spatial computing, and dual displays with 23 million pixels', 'price' => 3699.00],
                ['name' => 'Apple Vision Pro 1TB', 'specs' => 'a massive 1TB storage option for spatial developer environments, pro video rendering, and extensive immersive apps', 'price' => 3899.00],
                ['name' => 'Apple Vision Pro Travel Case', 'specs' => 'a durable custom-designed travel case, shock-absorbing protective padding, and integrated compartments for battery and accessories', 'price' => 199.00],
                ['name' => 'Apple Vision Pro Battery', 'specs' => 'a high-performance external battery pack, precision machined aluminum housing, and up to 2.5 hours of continuous spatial use', 'price' => 199.00],
                ['name' => 'Apple Vision Pro Light Seal', 'specs' => 'a custom-fitted soft fabric light seal to block external stray light, improving spatial visual contrast and immersion', 'price' => 199.00],
                ['name' => 'Apple Vision Pro Light Seal Cushion', 'specs' => 'two replacement cushions in different sizes, comfortable premium fabric, and perfect facial compatibility for long use', 'price' => 29.00],
                ['name' => 'ZEISS Optical Inserts (Reader)', 'specs' => 'premium magnetic optical inserts for reader correction, perfect visual clarity, and simple snap-on alignment', 'price' => 99.00],
                ['name' => 'ZEISS Optical Inserts (Prescription)', 'specs' => 'precision prescription optical correction lenses custom-made for the user, ensuring sharp and accurate spatial tracking', 'price' => 149.00],
                ['name' => 'Apple Vision Pro Solo Knit Band', 'specs' => 'a unique 3D-knitted stretch band, dynamic adjustability, breathable fabric, and premium comfort for the back of the head', 'price' => 99.00],
            ],
        ];

        // 3. Populate Categories and Products
        foreach ($appleData as $categoryName => $products) {
            // Create Category
            $category = Category::updateOrCreate(
                ['name' => $categoryName],
                []
            );

            // Create 10 Products for this Category
            foreach ($products as $prod) {
                Product::updateOrCreate(
                    ['name' => $prod['name']],
                    [
                        'price' => $prod['price'],
                        'quantity' => rand(10, 100),
                        'category_id' => $category->id,
                        'image' => 'https://placehold.co/600x400/png',
                        'description' => $this->generateDescription($prod['name'], $categoryName, $prod['specs']),
                    ]
                );
            }
        }
    }
}
