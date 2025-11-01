
const SectionFour = () => {
    return (
        <section className="section-four-container container">
            <div className="section-four-content">
                <div className="section-four-left">
                    <div className="section-four-vertical-text">
                        <span>Illuminating</span>
                        <span>Spaces</span>
                        <span>with</span>
                        <span>Innovation</span>
                        <span>&</span>
                        <span>Excellence</span>
                    </div>
                    <div className="section-four-main-content">
                        <h2>Miro's vision.</h2>
                        <p>Become the leading provider of high-quality, contemporary lighting solutions that transform spaces and exceed customer expectations.</p>
                        <a href="/about-us" className="cta-button section-four-cta-button">Get inspired</a>
                    </div>
                </div>
                <div className="section-four-right">
                    <img src="/images/miro-vision.jpg" alt="Miro Vision"
                        className="section-four-image" />
                </div>
            </div>
        </section>
    );
};

export default SectionFour;