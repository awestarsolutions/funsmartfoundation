<x-public-layout>
    @section('title', 'About Us | Fun Smart Foundation')
    @section('meta_description', 'Learn about Fun Smart Foundation, our mission, vision, and core values that drive our Corporate Social Responsibility work.')

    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1>About Fun Smart Foundation</h1>
            <p style="max-width: 700px; margin: 0 auto;">Dedicated to creating sustainable social impact by connecting communities, organizations, and changemakers through thoughtfully designed development initiatives.</p>
        </div>
    </header>

    <!-- Main Content -->
    <section class="page-section">
        <div class="container grid-2-col">
            <div>
                <h2>Meaningful change happens when compassion meets structured execution.</h2>
                <p>By working alongside corporations, educational institutions, local communities, and volunteers, we transform CSR commitments into initiatives that improve lives and strengthen society.</p>
                <p>Every project we undertake is guided by accountability, transparency, collaboration, and measurable outcomes.</p>
            </div>
            <div>
                <img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&q=80&w=800" alt="Team collaborating" style="border-radius: var(--radius-md);" />
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="about-section" style="background-color: var(--color-surface); padding: var(--space-12) 0;">
        <div class="container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: var(--space-8);">
            <div>
                <h3 style="color: var(--color-secondary);">Our Vision</h3>
                <p>{{ \App\Models\Setting::where('key', 'about_vision')->value('value') ?? 'To create a future where every organization actively contributes to building healthier, stronger, and more inclusive communities.' }}</p>
            </div>
            <div>
                <h3 style="color: var(--color-secondary);">Our Mission</h3>
                <p>{{ \App\Models\Setting::where('key', 'about_mission')->value('value') ?? 'To design and implement impactful CSR initiatives that empower communities, promote sustainable development, and enable organizations to create measurable social value.' }}</p>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="page-section">
        <div class="container">
            <div style="text-align: center; margin-bottom: var(--space-8);">
                <h2>Our Core Values</h2>
                <p>The principles that guide our work and partnerships.</p>
            </div>
            
            <div class="grid-3">
                <div class="card value-card" style="padding: var(--space-5);">
                    <h4>Integrity</h4>
                    <p>Every initiative is delivered with transparency and accountability.</p>
                </div>
                <div class="card value-card" style="padding: var(--space-5);">
                    <h4>Collaboration</h4>
                    <p>Strong partnerships create stronger communities.</p>
                </div>
                <div class="card value-card" style="padding: var(--space-5);">
                    <h4>Sustainability</h4>
                    <p>Long-term solutions over temporary interventions.</p>
                </div>
                <div class="card value-card" style="padding: var(--space-5);">
                    <h4>Innovation</h4>
                    <p>Modern approaches to solving community challenges.</p>
                </div>
                <div class="card value-card" style="padding: var(--space-5);">
                    <h4>Impact</h4>
                    <p>Every project should create measurable and lasting change.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div style="max-width: 600px; margin: 0 auto; position: relative; z-index: 2;">
            <h2>Let's Build Meaningful Impact Together.</h2>
            <p>Partner with Fun Smart Foundation to build stronger communities through responsible, transparent, and measurable CSR programs.</p>
            <div style="margin-top: var(--space-6); display: flex; gap: var(--space-4); justify-content: center;">
                <a href="{{ route('public.contact') }}" class="btn btn-secondary" style="background-color: var(--color-surface); color: var(--color-primary); border-color: transparent;">Schedule a Consultation</a>
            </div>
        </div>
    </section>
</x-public-layout>
