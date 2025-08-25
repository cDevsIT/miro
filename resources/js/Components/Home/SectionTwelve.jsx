import React from 'react';

function SectionTwelve() {
    return (
        <div className="section-twelve-container container-left-offset">
            <div className="section-twelve-wrapper">
                <div className="section-twelve-grid">
                    <div className="section-twelve-image-container">
                        <img
                            src="/images/miro-get-in-touch.jpg" alt="Miro Footer"
                            className="section-twelve-image"
                        />
                    </div>
                    <div className="section-twelve-content">
                        <h2 className="section-twelve-title">Get in Touch</h2>
                        <p className="section-twelve-description">
                            Let's Illuminate Your Space! <br />
                            For personalized lighting solutions or inquiries, reach out to us today.
                        </p>
                        <a href='/contact' className="cta-button section-twelve-button">
                            Get in touch
                        </a>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default SectionTwelve;