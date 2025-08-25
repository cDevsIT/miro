const SectionOne = () => {
    return (
        <section className='hero-container'>
            <div className="hero-container-wrapper container-left-offset">
            {/* Mobile Background Image */}
            <div className="mobile-image">
                <img
                    src="/images/miro-landing-1.jpg" alt="Home Section"
                />
                <div className="overlay"></div>
            </div>

            {/* Content Container */}
            <div className="content">
                {/* Text Content */}
                <div className="text-content">
                    <div className="text-wrapper">
                        <p className="subtitle">
                            Turning Spaces into Stories Through Light
                        </p>
                        <h1 className="title">
                            Transforming
                            <br />
                            Spaces
                            <br />
                            Inspiring
                            <br />
                            Light
                        </h1>
                        <a href='/products/category/indoor' className="cta-button section-one-cta-button">
                            Discover Products
                        </a>
                    </div>
                </div>

                {/* Desktop Image */}
                <div className="desktop-image">
                    <img
                        src="/images/miro-landing-1.jpg" alt="Home Section"
                    />
                </div>
            </div>
            </div>
        </section>
    );
};

export default SectionOne;