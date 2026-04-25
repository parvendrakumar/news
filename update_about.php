<?php
$content = <<<EOT
<div class="about-hero mb-5">
    <p class="lead font-bold text-slate-800" style="font-size: 1.25rem;">City News is your premier destination for high-quality journalism, bringing you the pulse of India and the world with integrity and speed.</p>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-6">
        <div class="p-4 bg-red-50 rounded-3xl border border-red-100">
            <h4 class="font-black text-red-600 uppercase tracking-widest text-sm mb-3">Our Mission</h4>
            <p class="text-slate-600 font-bold text-sm">To empower every citizen with accurate, unbiased, and timely news. We believe that information is the bedrock of democracy, and we strive to provide a platform where every voice matters.</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="p-4 bg-slate-50 rounded-3xl border border-slate-100">
            <h4 class="font-black text-slate-900 uppercase tracking-widest text-sm mb-3">Our Vision</h4>
            <p class="text-slate-600 font-bold text-sm">To be the most trusted digital news ecosystem in India, leveraging cutting-edge technology to deliver immersive storytelling through videos, visual stories, and real-time updates.</p>
        </div>
    </div>
</div>

<h3 class="font-black text-slate-900 mb-4">Why Choose City News?</h3>
<ul class="space-y-4 mb-5 list-none p-0">
    <li class="d-flex align-items-start gap-3">
        <div class="h-6 w-6 rounded-full bg-green-100 text-green-600 d-flex align-items-center justify-content-center flex-shrink-0 mt-1">
            <i class="fas fa-check" style="font-size: 10px;"></i>
        </div>
        <div>
            <strong class="text-slate-900">Verified Journalism:</strong> 
            <span class="text-slate-600">Our fact-checking team works around the clock to ensure every story is backed by solid evidence.</span>
        </div>
    </li>
    <li class="d-flex align-items-start gap-3">
        <div class="h-6 w-6 rounded-full bg-green-100 text-green-600 d-flex align-items-center justify-content-center flex-shrink-0 mt-1">
            <i class="fas fa-check" style="font-size: 10px;"></i>
        </div>
        <div>
            <strong class="text-slate-900">Hyper-Local & Global:</strong> 
            <span class="text-slate-600">From the smallest village issues to global geopolitics, we cover it all with equal depth.</span>
        </div>
    </li>
    <li class="d-flex align-items-start gap-3">
        <div class="h-6 w-6 rounded-full bg-green-100 text-green-600 d-flex align-items-center justify-content-center flex-shrink-0 mt-1">
            <i class="fas fa-check" style="font-size: 10px;"></i>
        </div>
        <div>
            <strong class="text-slate-900">Modern Experience:</strong> 
            <span class="text-slate-600">Experience news like never before with our Visual Stories and immersive video content.</span>
        </div>
    </li>
</ul>

<div class="p-5 bg-slate-900 rounded-[2.5rem] text-white text-center shadow-2xl overflow-hidden position-relative">
    <div style="position:absolute; top:-50px; right:-50px; width:150px; height:150px; background:rgba(220,38,38,0.2); border-radius:50%; filter:blur(40px);"></div>
    <h3 class="text-white font-black mb-3">Join Our Community</h3>
    <p class="text-slate-400 font-bold mb-4">Subscribe to our newsletter and stay ahead of the curve with daily insights.</p>
    <a href="/register" class="btn btn-danger rounded-pill px-5 py-3 font-black text-sm uppercase tracking-widest">Register Now</a>
</div>
EOT;

try {
    $p = new PDO('mysql:host=localhost;dbname=news', 'root', '');
    $stmt = $p->prepare("UPDATE page_translations pt JOIN pages p ON p.id = pt.page_id SET pt.content = ? WHERE p.slug = 'about-us'");
    $stmt->execute([$content]);
    echo "Content updated successfully.";
} catch (Exception $e) {
    echo $e->getMessage();
}
