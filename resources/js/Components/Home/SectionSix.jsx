import React from 'react';

const SectionSix = () => {
    return (
        <section className="section-six-container container">
            <div className="section-six-content">
                <div className="section-six-text-content">
                    <h2 className="section-six-title">Get a Quotation</h2>
                    <h3 className="section-six-subtitle">Lighting Solutions Perfectly <br/> Crafted for Your Vision!</h3>
                    <p className="section-six-paragraph">
                        At Miro Lighting Solutions, we create custom lighting designs for residential, commercial, and industrial spaces—crafted to fit your specific requirements.
                    </p>
                    <a href='/mymiro/login' className="cta-button section-six-button">Get a Quotation</a>
                </div>
                <div className="section-six-image-container">
                    <img
                        src="/images/miro-get-a-quotation.WebP"
                        alt="miro-get-a-quotation"
                        className="section-six-image"
                    />
                </div>
            </div>
        </section>
    );
};

export default SectionSix;