import React from 'react';
import '../../css/about-us.css';
import aboutUs from '../../../public/images/about_us/CHARACTERS.png';
import aboutUsMobile from '../../../public/images/about_us/about_mobile.png';
import Light from '../../icons/light';
import residential from '../../../public/images/about_us/residential.jpg';
import commercial from '../../../public/images/about_us/commercial.jpg';
import industrial from '../../../public/images/about_us/industrial.WebP';
import TIMELINE from '../../../public/images/about_us/timeline.jpg';
import HomeIcon from '../../../public/images/about_us/industry.png';
import SpotLight from '../../../public/images/about_us/spotLight.png';
import MiroLogo from '../../../public/images/about_us/logo_blue.png';
import WhyUs from '../../../public/images/about_us/why_us.jpg';
import ShowerIcon from '../../icons/Shower';
import VerifiedIcon from '../../icons/Verified';
import SolutionsIcon from '../../icons/solutions-icon';

const AboutUs = () => {

    return (
        <>
            {/* Section-1 Banner with Image and Heading*/}
            <div className='about-box' >
                <div className='about-image-box'>
                    <img src={aboutUs} alt='image for about us part' className='about-image' />
                    <img src={aboutUsMobile} alt='image for about us part' className='about-image-mobile' />
                </div>
                <div className='about-bannerHeading' >
                    <div className='about-light-image-box' >
                        <Light className='about-lightImage' />
                    </div>
                    <div className='about-heading-box' >
                        <h1 className='about-heading' > Lighting the Way Forward </h1>
                    </div>
                    <div className='about-description-box' >
                        <p className='about-description' > United as a team, we at Miro are lighting </p>
                        <div className='about-desc-short' >
                            the way forward <br/>innovating <br/>collaborating <br/>& <br/>achieving <br/>together!
                        </div>
                    </div>
                </div>
            </div>

            {/* Section-2 */}
            <div className="smart-lighting-content">
                <div className="smart-lighting-content-center container">
                    <div className="smart-lighting-heading">
                        <h2>Smart Lighting <br/>Sustainable Solutions <br/>Brighter Futures</h2>
                    </div>
                    <div className="smart-lighting-description">
                        <p>Miro lighting solutions was established with a vision to bring excellent quality lights to the market, addressing the significant gap in high-quality, well-designed lighting solutions. Our mission is to provide customers with top-tier, contemporary lighting products that enhance the aesthetics and functionality of any space. Through thorough market analysis, we identified a critical need for superior design and quality in the current lighting market, which drives our commitment to excellence.</p>
                    </div>
                </div>
                <div className="smart-lighting-line-at-bottom"></div>
            </div>

            {/* Section-3 Functionality Meets Style */}
            <div className='style-box container' >
                <h2> Where Functionality Meets Style – Elevate Your Space with </h2>
                <p> Miro Lighting Solutions delivers tailored illumination that enhances every element of design. Our lighting doesn’t just brighten a room it brings depth, functionality and warmth, making each space feel unique and inspired. </p>
                <div className='style-image-txt-box' >
                    <div className='style-image-txt-box-div' >
                        <div className='style-image-box' >
                            <img src={residential} alt="About Us Second Image" className='style-image' />
                        </div>
                        <h3> Residential 
                            <div className='style-image-txt-box-hover-bar' ></div>
                        </h3>
                    </div>
                    <div className='style-image-txt-box-div' >
                        <div className='style-image-box' >
                            <img src={industrial} alt="About Us Second Image" className='style-image' />
                        </div>
                        <h3> Industrial 
                            <div className='style-image-txt-box-hover-bar' ></div>
                        </h3>
                    </div>
                    <div className='style-image-txt-box-div' >
                        <div className='style-image-box' >
                            <img src={commercial} alt="About Us Second Image" className='style-image' />
                        </div>
                        <h3> Commercial 
                            <div className='style-image-txt-box-hover-bar' ></div>
                        </h3>
                    </div>
                </div>
            </div>

            {/* Section-4 Unique Work and Demand */}
            <div className='unique-box'>
                <div className='container'>

                    <div className='unique-heading' >
                        <h2> What we bring to the market </h2>
                    </div>
                    <div className="unique-cards">
                        <div className='unique-image-box' >
                            <div className='unique-icon-box' >
                                <ShowerIcon className='unique-icon' />
                            </div>
                            <div className='unique-border'></div>
                            <div className='unique-icon-details' >
                                <h3>aesthetic design</h3>
                                <p>Miro enhances spaces with modern, visually captivating lighting designs tailored to your style.</p>
                            </div>
                        </div>
                        <div className='unique-image-box' >
                            <div className='unique-icon-box' >
                            <SolutionsIcon className='unique-icon' />
                            </div>
                            <div className='unique-border'></div>
                            <div className='unique-icon-details' >
                                <h3>verified solution</h3>
                                <p>Our lighting solutions are engineered for optimal performance and seamless adaptability to any environment.</p>
                            </div>
                        </div>
                        <div className='unique-image-box' >
                            <div className='unique-icon-box unique-icon-box-last' >
                                <VerifiedIcon className='unique-icon' />
                            </div>
                            <div className='unique-border'></div>
                            <div className='unique-icon-details' >
                                <h3>functional performance</h3>
                                <p>Miro ensures reliability and quality with meticulously tested and certified lighting products.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Section-5 */}
            <div className="miro-timeline-section container-right-offset">

                <div className="miro-timeline-container">

                    <div className="miro-timeline-heading-container">
                        <h2>
                            Miro's Timeline: A Legacy of Innovation
                        </h2>
                    </div>

                    <div className="miro-timeline-description">
                        <p>
                            Miro Lighting Solutions traces its roots back to 1995 with the inception of <span> Metaphor </span>, laying the foundation for thoughtful design. In 2004, <span> DWm4 Architects & nextSPACES </span> elevated the legacy, blending architectural brilliance with innovation. From DWm4 Architects, DWm4 Intrends and DWm4 Enterprise were born, further diversifying expertise. These entities, along with <span> nextSPACES </span> , came together to form Miro Lighting Solutions in 2024. <br/>Today, Miro continues to deliver sustainable, innovative lighting designs that redefine spaces, combining a rich history with modern ingenuity to illuminate a brighter future for its clients and the environments they cherish.
                        </p>
                    </div>
                </div>

                <div className="miro-timeline-column-two">
                    <img src={TIMELINE} alt="Miro's Timeline" />
                </div>

            </div>

            {/* Section-6 Why Choose Us */}
            <div className="why-choose-us-container">
                <div className="why-choose-us container">
                    <div className="why-choose-us-image-box">
                        <img src={WhyUs} alt="Light Supply Image" className="light-bulb-image" />
                    </div>
                    <div className="why-choose-us-details">
                            <ul>
                                <li><strong>Reliable Stock Availability:</strong> Consistently maintain inventory with a lead time of 45 days.</li>
                                <li><strong>Superior CRI Standards:</strong> Guarantee color rendering index (CRI) values of over 90 and up to 97 for vibrant, accurate lighting.</li>
                                <li><strong>Exclusive Patented Driver:</strong> Offer advanced technology ensuring stable performance and non-flickering illumination.</li>
                                <li><strong>High PF Efficiency:</strong> Deliver high Power Factor (PF) for enhanced energy efficiency and reduced power loss.</li>
                                <li><strong>Extensive Accessory Options:</strong> Provide a wide range of accessories for diverse customization to meet specific lighting needs.</li>
                            </ul>
                    </div>
                </div>
            </div>

            {/* Section-7 Illuminating Bangladesh */}
            <div className='illuminate-box container'>
                <div className='illuminate-details' >
                    <h2> Illuminating Bangladesh with Global Expertise! </h2>
                    <p> Miro bridges the gap in Bangladesh’s lighting industry with premium, durable solutions adjust to every need. Our factory in Xiao Lan, China, a global lighting hub, ensures top-notch quality, customizable designs, and reliable product longevity. <br/>With a focus on innovation and seamless delivery, we simplify lighting for interior projects, meeting the growing demand for excellence. </p>
                </div>
                <div className='illuminate-icon-box' >
                    <img src={HomeIcon} alt="Home Icon" />
                </div>
            </div>

            {/* Section-8 Miro-Light */}
            <div className='miroLight-box container' >
                <div className='miroLight-icon-box' >
                    <img src={SpotLight} alt="Spot Light for Miro" />
                </div>
                <div className='miroLight-details' >
                    <img src={MiroLogo} alt="Miro" />
                    <h3> Miro: Illuminating Bangladesh with <br/>Precision <br/>Durability <br/>and Innovation!</h3>
                </div>
            </div>

            {/* Section-9 Details Only */}
            <div className='details-style-box container' >
                <h2> More Than Lighting. It’s About Transforming Spaces with Precision and Innovation </h2>
                <p> Miro Lighting Solutions is more than just a lighting provider—we’re your trusted partner in transforming spaces. With a commitment to quality, innovation, and customer satisfaction, we deliver tailored solutions that blend aesthetics with functionality. By bridging global expertise with local needs, Miro ensures every project shines with precision and excellence, making us the ultimate choice for all your lighting needs. </p>
            </div>
        </>
    );
};

export default AboutUs; 