import React from 'react';

import SectionFive from './Home/SectionFive';
import SectionSix from './Home/SectionSix';
import SectionFour from './Home/SectionFour';
import SectionThree from './Home/SectionThree';
import SectionTwo from './Home/SectionTwo';
import SectionOne from './Home/SectionOne';
import SectionSeven from './Home/SectionSeven';
import SectionEight from './Home/SectionEight';
import SectionNine from './Home/SectionNine';
import SectionTen from './Home/SectionTen';

import '../../css/home.css'
import SectionEleven from './Home/SectionEleven';
import SectionTwelve from './Home/SectionTwelve';


const Home = () => {

    return (
        <main>
            {/* Hero Section */}


            <SectionOne />

            {/* Second Section */}
            {/* <section className="home-section-2">
                <div className="container">
                    <div className="home-section-2-left">
                        <h2>Crafting Light<br />Shaping Atmospheres<br />Lighting Solutions That Inspire</h2>
                    </div>
                    <div className="home-section-2-right">
                        <p>Founded in 2024, Miro Lighting Solutions is dedicated to delivering high-quality, contemporary lighting that transforms spaces. Our state-of-the-art factory enables us to craft custom solutions that blend aesthetics and functionality. Our expert team collaborates closely with clients to bring their vision to life, ensuring precision, superior performance, and lasting durability. From residential to commercial and industrial projects, Miro Lighting consistently exceeds expectations with innovative, inspiring designs.</p>
                    </div>
                </div>
            </section> */}

            <SectionTwo />


            {/* Miro Selection Section */}
            {/* <section className="home-section-3">
                <div className="container">
                    <div className="home-section-3-top">
                        <h2>Miro Selection</h2>
                        <p>Handpicked products for unparalleled lighting experiences</p>
                    </div>
                    <div className="home-section-3-bottom">
                        <div className="product-card">
                            <img src="/images/miro-selection-1.jpg" alt="Adjustable Surface Mounted" />
                            <h3>Adjustable Surface Mounted</h3>
                        </div>
                        <div className="product-card">
                            <img src="/images/miro-selection-2.jpg" alt="Non-Adjustable Surface Mounted" />
                            <h3>Non-Adjustable Surface Mounted</h3>
                        </div>
                        <div className="product-card">
                            <img src="/images/miro-selection-3.jpg" alt="Wire Track Luminaire" />
                            <h3>Wire Track Luminaire</h3>
                        </div>
                    </div>
                </div>
            </section> */}

            <SectionThree />

            {/* Vision Section */}
            {/* <section className="home-section-4">
                <div className="container">
                    <div className="home-section-4-left">
                        <h2>Illuminating<br />Spaces with<br />Innovation &<br />Excellence</h2>
                    </div>
                    <div className="home-section-4-middle">
                        <h3>Miro's vision.</h3>
                        <p>Become the leading provider of high-quality, contemporary lighting solutions that transform spaces and exceed customer expectations.</p>
                        <button>Get inspired</button>
                    </div>
                    <div className="home-section-4-right">
                        <img src="/images/miro-vision.jpg" alt="Miro Vision" />
                    </div>
                </div>
            </section> */}

            <SectionFour />

            {/* Best Seller Section */}
            {/* <section className="home-section-5">
                <div className="container">
                    <div className="home-section-5-header">
                        <div className="home-section-5-header-content">
                            <h2>Best Seller</h2>
                            <p>Explore our latest lighting solutions, combining innovative design with exceptional quality. Illuminate your space with fresh styles that inspire and transform.</p>
                        </div>
                        <div className="carousel-nav">
                            <button className="carousel-nav-button" id="prevBtn">←</button>
                            <button className="carousel-nav-button" id="nextBtn">→</button>
                        </div>
                    </div>

                    <div className="carousel-wrapper">
                        <div className="carousel-container">
                            <div className="home-carousel">
                                <div className="home-carousel-item">
                                    <img src="/images/miro-carousel-1.jpg" alt="Modular Recessed" />
                                    <h3>Modular Recessed</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> */}

            <SectionFive />

            {/* Get a Quotation Section */}
            {/* <section className="home-section-6">
                <div className="container">
                    <div className="home-section-6-content">
                        <div className="home-section-6-left">
                            <h2>Get a Quotation</h2>
                            <h3>Lighting Solutions Perfectly<br />Crafted for Your Vision!</h3>
                            <p>At Miro Lighting Solutions, we create custom lighting designs for residential, commercial, and industrial spaces—crafted to fit your specific requirements.</p>
                            <button className="quotation-btn">Get a Quotation</button>
                        </div>
                        <div className="home-section-6-right">
                            <img src="/images/miro-get-a-quotation.jpg" alt="Get a Quotation" />
                        </div>
                    </div>
                </div>
            </section> */}
            <SectionSix />

            {/* Blog Section */}
            {/* <section>
                <div className="container">
                    <div className="home-section-7-left">
                        <h2>5 Ways to Elevate Your Space with Modern Lighting Solutions</h2>
                        <p>Imagine a room where lighting isn't just functional but an experience. Modern solutions like layered, dimmable, and accent lighting transform your space, creating the perfect ambiance. These innovations bring mood, depth, and warmth, turning any room into a carefully crafted environment. Let's explore how lighting shapes your space enhance every moment.</p>
                        <button>Read More</button>
                    </div>
                    <div className="home-section-7-right">
                        <img src="/images/miro-5-ways-to-elevate-your-space.jpg" alt="Miro Footer" />
                    </div>
                </div>
            </section> */}
            <SectionSeven />

            {/* Installation Experience Section */}
            {/* <section>
                <div className="container">
                    <div className="home-section-8-left">
                        <h2>The Miro Light Installation Experience: Bringing You Vision to Life</h2>
                        <p>Transform your space effortlessly with the Miro Light Installation Experience. Our experts provide personalized consultations, precise site assessments, and flawless installations. Discover customizable lighting solutions crafted to perfection, backed by ongoing support to ensure brilliance that lasts. Let us bring your vision to life with unmatched expertise and care.</p>
                        <button>Read More</button>
                    </div>
                    <div className="home-section-8-right">
                        <img src="/images/miro-vision-to-life.jpg" alt="Miro Footer" />
                    </div>
                </div>
            </section> */}

            <SectionEight />

            {/* About Us Section */}
            {/* <section>
                <div className="container">
                    <div className="home-section-9-left">
                        <img src="/images/miro-about-us.jpg" alt="Miro Footer" />
                    </div>
                    <div className="home-section-9-right">
                        <h2>About Us</h2>
                        <p>Transform your space effortlessly with the Miro Light Installation Experience. Our experts provide personalized consultations, precise site assessments, and flawless installations. Discover customizable lighting solutions crafted to perfection, backed by ongoing support to ensure brilliance that lasts. Let us bring your vision to life with unmatched expertise and care.</p>
                        <button>Read More</button>
                    </div>
                </div>
            </section> */}
            <SectionNine />

            {/* New to Miro Section */}
            {/* <section>
                <div className="container">
                    <div className="home-section-10-left">
                        <h2>New to Miro?</h2>
                        <p>Sign up today and discover how our custom lighting solutions can transform your space.</p>
                        <button>Sign up</button>
                    </div>
                    <div className="home-section-10-right">
                        <img src="/images/new-to-miro.jpg" alt="Miro Footer" />
                    </div>
                </div>
            </section> */}
            <SectionTen />

            {/* Services Section */}
            {/* <section>
                <div className="container">
                    <div className="home-section-11-top">
                        <h2>Our Services</h2>
                        <p>Expert Lighting Solutions Tailored to Your Needs</p>
                        <button>Get Services</button>
                    </div>
                    <div className="home-section-11-bottom">
                        <img src="/images/miro-services.jpg" alt="Miro Footer" />
                    </div>
                </div>
            </section> */}

            <SectionEleven />

            {/* Get in Touch Section */}
            {/* <section>
                <div className="container">
                    <div className="home-section-12-left">
                        <img src="/images/miro-get-in-touch.jpg" alt="Miro Footer" />
                    </div>
                    <div className="home-section-12-right">
                        <h2>Get in Touch</h2>
                        <p>Let's Illuminate Your Space!</p>
                        <p>For personalized lighting solutions or inquiries, reach out to us today.</p>
                        <button>Get in Touch</button>
                    </div>
                </div>
            </section> */}
            <SectionTwelve />
        </main>
    );
};

export default Home; 