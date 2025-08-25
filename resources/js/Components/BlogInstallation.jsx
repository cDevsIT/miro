import React from 'react';
import '../../css/blog-page2.css';
import img1 from "../../../public/images/BLOG The Miro Light Installation Experience/main pic.jpg";
import img2 from '../../../public/images/BLOG The Miro Light Installation Experience/picture 02.jpg';
import img3 from '../../../public/images/BLOG The Miro Light Installation Experience/picture 03.jpg';
import img4 from "../../../public/images/BLOG The Miro Light Installation Experience/picture 04.jpg";
import img5 from "../../../public/images/BLOG The Miro Light Installation Experience/picture 05.jpg";
import img6 from "../../../public/images/BLOG The Miro Light Installation Experience/picture 06.jpg";
import img7 from "../../../public/images/BLOG The Miro Light Installation Experience/picture 07.jpg";
import icon1 from "../../../public/images/BLOG 5 Ways to Elevate Your Space with/SHARE.svg";
import icon2 from "../../../public/images/BLOG 5 Ways to Elevate Your Space with/EMAIL LOGO.svg";
import icon3 from "../../../public/images/BLOG 5 Ways to Elevate Your Space with/FACEBOOK LOGO 60.svg";
import icon4 from "../../../public/images/BLOG 5 Ways to Elevate Your Space with/INSTRAGRAM LOGO 60.svg";
import icon5 from "../../../public/images/BLOG 5 Ways to Elevate Your Space with/LINKDIN LOGO BLACK 60.svg";

const BlogInstallation = () => {
    return (
        <>
            {/* Section - 1 Light Installation Experience */}
            <div className="blogBannerContainer">
                <img src={img1} alt="Service Image" className="blogBannerImage" />
            </div>

            <div className="detailsContainer">
                <div className="detailsText">
                    <div className="detailsIcons">
                        <img src={icon1} alt="Icon 1" className="blogDetailsImage" />
                        <div className="shareText">Share this blog</div>
                        <img src={icon2} alt="Icon 2" className="blogDetailsImage blogMobileVanish" />
                        <img src={icon3} alt="Icon 3" className="blogDetailsImage blogMobileVanish" />
                        <img src={icon4} alt="Icon 4" className="blogDetailsImage blogMobileVanish" />
                        <img src={icon5} alt="Icon 5" className="blogDetailsImage blogMobileVanish" />
                    </div>
                    <div className="detailsBorder"></div>
                    <div className="detailsTitle">The Miro Light Installation Experience: Bringing Your Vision to Life</div>
                </div>

                <div className="detailsDescription">
                    The Miro Light Installation experience, featuring expert consultations to understand your needs, thorough site assessments for optimal fixture placement, skilled technicians for precise installation, customizable lighting options, and ongoing support for lasting satisfaction.
                </div>
            </div>

            {/* Section-2 for Vision to Light Part */}
            <div className='fit-shine-box lighting-adapt' >

                <div className="fitShine-text-box">
                    <div className="text-fitShine">
                        <h2> Bringing Your Vision to Light </h2>
                        <p>At Miro Lighting Solutions, we believe that lighting is more than just a functional necessity; it’s an essential element that shapes the mood, aesthetics, and overall ambiance of a space. Our Light Installation service is designed to bring your vision to life, transforming your ideas into beautifully illuminated environments that enhance both beauty and functionality. Here’s a closer look at what you can expect from the Miro Light Installation experience.</p>
                    </div>
                </div>
                <div className="fitShine-image-box lighting-adapt-img-box">
                    <img src={img2} alt="Image for Fit and Shine of Miro" />
                </div>
                <div className="fitShine-gap-box"></div>

            </div>

            {/* Section-3 for Understanding Vision */}
            <div className='picture-text-blog-product' >
                <div className="pictureDiv visionPicture">
                    <img src={img3} alt="Service Image" className="detailsBannerImage" />
                </div>

                <div className="detailsImage visionText">
                    <div className="detailsHeadingImage">
                        Understanding your vision
                    </div>
                    <div className="detailsDescriptionImage">
                        Every great lighting project starts with your unique vision. At Miro Lighting Solutions, we don’t just provide lights, we bring your ideas to life. Whether you’re dreaming of a cozy, warm glow for your home, enhancing the ambiance of a commercial space, or setting the perfect mood for an event, we’re here to listen. Our team of experts works hand-in-hand with you, understanding your goals, preferences, and needs. This personalized approach ensures every detail is to align with your vision, creating a result that’s not just functional but truly remarkable. After all, your space deserves to shine as bright as your imagination.
                    </div>
                </div>
            </div>

            {/* Section-4 for Expert Assessment and Planning */}
            <div className='fit-shine-box lighting-adapt' >

                <div className="fitShine-gap-box"></div>
                <div className="fitShine-image-box lighting-adapt-img-box">
                    <img src={img4} alt="Image for Fit and Shine of Miro" />
                </div>
                <div className="fitShine-text-box">
                    <div className="text-fitShine">
                        <h2> Expert Assessment and Planning </h2>
                        <p>Once we understand your vision, we dive deep into your space, assessing every detail to bring it to life. From evaluating existing lighting and architectural features to understanding how you’ll use the space, we leave no stone unturned. Our expert team crafts a lighting plan that blends stunning aesthetics with practical efficiency. Every fixture, placement, and design element is carefully chosen to create the perfect ambiance, ensuring your space isn’t just illuminated, it’s transformed. With thoughtful planning, we turn your lighting dreams into a reality that shines brilliantly</p>
                    </div>
                </div>

            </div>

            {/* Section-5 for Professional Installation */}
            <div className='fit-shine-box' >

                <div className="fitShine-text-box">
                    <div className="text-fitShine">
                        <h2> Professional Installation </h2>
                        <p>At Miro Lighting Solutions, we bring your lighting vision to life with precision and care. Our skilled professionals ensure flawless installation, secure mounting, and seamless connections for any design. Working efficiently and maintaining a clean workspace, we minimize disruptions while delivering exceptional results. Trust Miro for a hassle-free experience and beautifully illuminated spaces that reflect your style.</p>
                    </div>
                </div>
                <div className="fitShine-image-box">
                    <img src={img5} alt="Image for Fit and Shine of Miro" />
                </div>
                <div className="fitShine-gap-box"></div>

            </div>

            {/* Section-6 for Testing and Adjustments Part */}
            <div className="statementMainSection">
                <div className="statementBorderSection">
                    <div className="rectangleImageSection">
                        <img src={img6} alt="Image" className="rectangleImage" />
                    </div>

                    <div className="statementTextSection">
                        <div className="rectangleSectionHeading">Testing and Adjustments</div>
                        <div className="rectangleSectionDescription">
                            After installation, we go the extra mile to ensure everything shines perfectly. Our team conducts thorough testing, checking every light for flawless performance. We fine tune brightness, color temperature, and positioning to create the ideal ambiance. It's not just about how your lighting looks, it's about how it transforms your space, enhancing both beauty and functionality with every detail perfected.
                        </div>
                    </div>
                </div>
            </div>

            {/* Section-7 for Post Installation Support */}
            <div className='fit-shine-box lighting-adapt special-post' >

                <div className="fitShine-text-box">
                    <div className="text-fitShine">
                        <h2> Post-Installation Support </h2>
                        <p>At Miro Lighting Solutions, we’re with you long after the lights come on. Our commitment extends beyond installation, offering dedicated support and maintenance to keep your lighting shining at its best. Whether it’s troubleshooting, adjustments, or upgrades, our team is just a call away, ensuring your space stays as brilliant as your vision. <br /> <br /> Let Miro turn your vision into reality. Reach out to us today to discover expertly crafted lighting solutions tailored to your unique needs, enhancing your space with unmatched beauty, functionality, and innovation. </p>
                    </div>
                </div>
                <div className="fitShine-image-box lighting-adapt-img-box">
                    <img src={img7} alt="Image for Fit and Shine of Miro" />
                </div>
                <div className="fitShine-gap-box"></div>

            </div>
        </>
    );
};

export default BlogInstallation; 