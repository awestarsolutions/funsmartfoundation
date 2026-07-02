<x-public-layout>
    @section('title', 'Our Impact | Fun Smart Foundation')
    @section('meta_description', 'Discover the social and environmental impact of Fun Smart Foundation. Read our timeline, statistics, and stories of change.')

    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1>{!! nl2br(e(\App\Models\Setting::where('key', 'impact_title')->value('value') ?? 'Measurable Change. Human Impact.')) !!}</h1>
            <p style="max-width: 700px; margin: 0 auto;">{{ \App\Models\Setting::where('key', 'impact_subtitle')->value('value') ?? 'Beyond the numbers, we trace the threads of progress across communities, creating a sustainable future through radical transparency and community-led growth.' }}</p>
        </div>
    </header>

    <!-- Impact Stats -->
    <section class="page-section" style="background-color: var(--color-surface);">
        <div class="container">
            <div class="grid-4">
                <div class="impact-stat">
                    <h3 class="counter" data-target="25">0</h3>
                    <p>Thousand+ Lives Empowered</p>
                </div>
                <div class="impact-stat">
                    <h3 class="counter" data-target="100">0</h3>
                    <p>Projects Successfully Scaled</p>
                </div>
                <div class="impact-stat">
                    <h3 class="counter" data-target="15">0</h3>
                    <p>Communities Served Globally</p>
                </div>
                <div class="impact-stat">
                    <h3 class="counter" data-target="50">0</h3>
                    <p>Corporate Collaborations</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Stories -->
    <section class="page-section">
        <div class="container" style="display: flex; flex-direction: column; gap: var(--space-8);">
            <!-- Story 1 -->
            <div class="grid-2-col" style="align-items: center;">
                <div>
                    <span class="badge">Sustainable Growth</span>
                    <h2>Empowering Agri-tech Livelihoods</h2>
                    <p>Through our structured vocational training and micro-enterprise grants, we helped community members construct solar-powered learning facilities and greenhouses, boosting yields and providing steady income to dozens of families.</p>
                    <a href="{{ route('public.activities') }}" style="color: var(--color-primary); font-weight: 500;">View Activities →</a>
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1544027993-37dbfe43562a?auto=format&fit=crop&q=80&w=800" alt="Agri-tech" style="border-radius: var(--radius-md);" />
                </div>
            </div>

            <!-- Story 2 -->
            <div class="grid-2-col" style="align-items: center;">
                <div>
                    <img src="https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?auto=format&fit=crop&q=80&w=800" alt="Education" style="border-radius: var(--radius-md);" />
                </div>
                <div>
                    <span class="badge">Digital Equity</span>
                    <h2>Bridging the Literacy Gap</h2>
                    <p>Our digital classrooms in semi-urban sectors have trained thousands of young adults in foundational digital literacy and vocational computing, enabling them to secure remote support roles and boost local average household incomes.</p>
                    <a href="{{ route('public.activities') }}" style="color: var(--color-primary); font-weight: 500;">View Activities →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- JS Counter Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.counter');
            
            const animate = (counter) => {
                const target = parseFloat(counter.getAttribute('data-target'));
                const isDecimal = target % 1 !== 0;
                let current = 0;
                const increment = target / 100;
                
                const updateCount = () => {
                    current += increment;
                    if (current < target) {
                        counter.innerText = isDecimal ? current.toFixed(1) : Math.floor(current);
                        setTimeout(updateCount, 15);
                    } else {
                        counter.innerText = target + (counter.parentElement.innerText.includes('+') ? '+' : '');
                    }
                };
                updateCount();
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if(entry.isIntersecting) {
                        animate(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            counters.forEach(c => observer.observe(c));
        });
    </script>
</x-public-layout>
