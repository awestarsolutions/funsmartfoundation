<x-public-layout>
    @section('title', 'Contact Us | Fun Smart Foundation')
    @section('meta_description', 'Contact the Fun Smart Foundation team to discuss Corporate Social Responsibility partnerships, consultations, or community initiatives.')

    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1>Let's Build Impact Together</h1>
            <p style="max-width: 700px; margin: 0 auto;">Whether you're exploring CSR partnerships, employee engagement programs, volunteering initiatives, or community development projects, we'd love to collaborate.</p>
        </div>
    </header>

    <!-- Main Content -->
    <section class="page-section">
        <div class="container">
            
            @if(session('success'))
                <div style="background-color: #d1e7dd; color: #0f5132; padding: var(--space-4); border-radius: var(--radius-md); border: 1px solid #badbcc; margin-bottom: var(--space-6); font-size: 0.95rem; font-weight: bold; display: flex; align-items: center; gap: var(--space-2);">
                    <span class="material-symbols-outlined">check_circle</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid-2-col">
                <div>
                    <div class="contact-info">
                        <h3>Get in Touch</h3>
                        <p>Contact our team to discuss your CSR objectives and discover how we can help create meaningful social impact.</p>
                        
                        <div style="margin-top: var(--space-6);">
                            <div style="margin-bottom: var(--space-4);">
                                <strong style="display: block; margin-bottom: var(--space-1); color: var(--color-text);">Address</strong>
                                <p style="margin: 0; white-space: pre-line;">{{ $settings['contact_address'] ?? "123 Impact Way, Sustainability City\nGlobal Enterprise Zone, 10001" }}</p>
                            </div>
                            <div style="margin-bottom: var(--space-4);">
                                <strong style="display: block; margin-bottom: var(--space-1); color: var(--color-text);">Email</strong>
                                <p style="margin: 0;">{{ $settings['contact_email'] ?? 'contact@funsmartfoundation.org' }}</p>
                            </div>
                            <div>
                                <strong style="display: block; margin-bottom: var(--space-1); color: var(--color-text);">Phone</strong>
                                <p style="margin: 0;">{{ $settings['contact_phone'] ?? '+1 (234) 567-8900' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <form method="POST" action="{{ route('public.contact.submit') }}" class="contact-form">
                        @csrf
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" placeholder="Jane Doe" required />
                        </div>
                        <div class="form-group">
                            <label for="email">Work Email</label>
                            <input type="email" id="email" name="email" placeholder="jane@company.com" required />
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number (Optional)</label>
                            <input type="text" id="phone" name="phone" placeholder="+1 (234) 567-8900" />
                        </div>
                        <div class="form-group">
                            <label for="company_name">Company / Organization</label>
                            <input type="text" id="company_name" name="company_name" placeholder="Acme Corp" />
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="5" placeholder="Tell us about your CSR objectives..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top: var(--space-4); align-self: flex-start;">Schedule a Consultation</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
