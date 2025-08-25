import React from 'react';

function SectionNine() {
    return (
        <div className="section-nine-container container-left-offset">
            <div className="section-nine-wrapper">
                <div className="section-nine-grid">
                    <div className="section-nine-image-container">
                        <img
                            src="/images/miro-about-us.WebP" alt="Miro About Us"
                            className="section-nine-image"
                        />
                    </div>
                    <div className="section-nine-content">
                        <h2 className="section-nine-title">About Us</h2>
                        <p className="section-nine-description">
                        Miro Lighting Solutions is a leader in innovative, customized lighting design. Specializing in residential and commercial spaces, we bring style and precision to create perfectly illuminated environments that customized to your needs.
                        </p>
                        <a href='/about-us' className="cta-button section-nine-button">
                            Read more
                        </a>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default SectionNine;