

function SectionEleven() {
    return (
        <section className="section-eleven-services-section container">
            <div className="section-eleven-services-content">
                <div className="section-eleven-services-text-content">
                    <div className="section-eleven-services-text-wrapper">
                        <h2 className="section-eleven-services-title">Our Services</h2>
                        <p className="section-eleven-services-description">
                            Expert Lighting Solutions Tailored to Your Needs
                        </p>
                    </div>
                    <a href='/services' className="cta-button section-eleven-cta-button">
                        Get Services
                    </a>
                </div>
                <div className="section-eleven-services-image-container">
                    <img
                        src="/images/miro-services.jpg" alt="Miro Service Van"
                        className="section-eleven-services-image"
                    />
                </div>
            </div>
        </section>
    )
}

export default SectionEleven