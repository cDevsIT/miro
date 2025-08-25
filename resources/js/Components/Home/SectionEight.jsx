import React from 'react';

function SectionEight() {
    return (
        <section className="section-eight-hero-section container">
            <div className="section-eight-content-container">
                <div className="section-eight-text-content">
                    <h2 className="section-eight-title">The Miro Light Installation Experience:<br/> Bringing You Vision to Life</h2>
                    <p className="section-eight-description">
                        Transform your space effortlessly with the Miro Light Installation Experience. Our experts provide personalized
                        consultations, precise site assessments, and flawless installations. Discover customizable lighting solutions
                        crafted to perfection, backed by ongoing support to ensure brilliance that lasts. Let us bring your vision to life
                        with unmatched expertise and care.
                    </p>
                    <a href="/installation" className="cta-button section-eight-button">Read more</a>
                </div>
                <div className="section-eight-image-container">
                    <img
                        src="/images/miro-vision-to-life.jpg" alt="Miro Footer"
                    />
                </div>
            </div>
        </section>
    );
}

export default SectionEight;