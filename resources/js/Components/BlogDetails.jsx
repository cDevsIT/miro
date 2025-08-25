import React from 'react';
import img1 from "../../../public/images/BLOG 5 Ways to Elevate Your Space with/MAIN PICTURE.jpg";
import img2 from "../../../public/images/BLOG 5 Ways to Elevate Your Space with/picture 02.jpg";
import img3 from "../../../public/images/BLOG 5 Ways to Elevate Your Space with/picture 03.jpg";
import img4 from "../../../public/images/BLOG 5 Ways to Elevate Your Space with/picture 04.jpg";
import img5 from "../../../public/images/BLOG 5 Ways to Elevate Your Space with/picture 05.jpg";
import img6 from "../../../public/images/BLOG 5 Ways to Elevate Your Space with/picture 06.jpg";
import icon1 from "../../../public/images/BLOG 5 Ways to Elevate Your Space with/SHARE.svg";
import icon2 from "../../../public/images/BLOG 5 Ways to Elevate Your Space with/EMAIL LOGO.svg";
import icon3 from "../../../public/images/BLOG 5 Ways to Elevate Your Space with/FACEBOOK LOGO 60.svg";
import icon4 from "../../../public/images/BLOG 5 Ways to Elevate Your Space with/INSTRAGRAM LOGO 60.svg";
import icon5 from "../../../public/images/BLOG 5 Ways to Elevate Your Space with/LINKDIN LOGO BLACK 60.svg";
import '../../css/blog-detail-page.css';



const BlogDetails = () => {

    const blogId = document.getElementById('blog-details').dataset.blogId;

    return (
        <>
            <div className="blogDetailContainer" >

                {/* Banner Image for The Details Page */}

                <div className="blogBannerContainer">
                    <img src={img1} alt="Service Image" className="blogBannerImage" />
                </div>

                {/* Text and Details after Banner */}

                <div className="blogDetailsContainer">
                    <div className="detailsText">
                        <div className="blogDetailsIcons">
                            <img src={icon1} alt="Icon 1" className="blogDetailsImage" />
                            <div > Share this blog </div>
                            <div className="shareIcon">
                                <img src={icon2} alt="Icon 2" className="blogDetailsImage" />
                                <img src={icon3} alt="Icon 3" className="blogDetailsImage" />
                                <img src={icon4} alt="Icon 4" className="blogDetailsImage" />
                                <img src={icon5} alt="Icon 5" className="blogDetailsImage" />
                            </div>
                        </div>
                        <div className="detailsBorder"></div>
                        <div className="detailsTitle">5 Ways to Elevate Your Space with Modern Lighting Solutions</div>
                    </div>

                    <div className="blogDetailsDescription">
                        Lighting is more than just a functional necessity; it's the secret ingredient that transforms a space from ordinary to extraordinary. Modern lighting solutions offer an incredible array of options to enhance ambiance, highlight architectural features, and create a space that truly feels like home.
                    </div>
                </div>

                {/* New Section for Blog Details Box */}

                <div className="rectangleMainSection">
                    <div className="blogRectangleTextSection">
                        <div className="rectangleSectionHeading">
                            Layer Your Lighting for <br /> Depth and Dimension
                        </div>
                        <div className="rectangleSectionDescription">
                            Gone are the days when a single overhead light was enough to illuminate a room. Modern spaces thrive on layered lighting, combining ambient, task, and accent lighting to create a balanced and visually dynamic atmosphere. Use recessed ceiling lights for a soft glow, table or floor lamps for reading and tasks, and spotlights to draw attention to artwork or design elements.
                        </div>
                    </div>

                    <div className="blogRectangleImageSection">
                        <img src={img2} alt="Image" className="blogRectangleImage" />
                    </div>
                </div>

                {/* Section for Picture and Text */}

                <div className='blogPictureDiv'>
                    <div className="" >
                        <img src={img3} alt="Service Image" className="detailsBannerImage" />
                    </div>

                    <div className="blogDetailsText" >
                        <div className="blogDetailsHeadingImage" >
                            Incorporate Dimmable Lighting for Versatility
                        </div>
                        <div className="blogDetailsDescriptionImage" >
                            Lighting isn't one-size-fits-all, and dimmable solutions allow you to customize your space for any mood or occasion. Brighten up your living room for gatherings or dim the lights for a cozy movie night. Dimmable LEDs are a smart and energy-efficient choice that adds versatility to any room.
                        </div>
                    </div>
               </div>

                {/* Highlight Section */}

                <div className="highlightsBlogGroup">

                    <div className="highlightMainSection">
                        <div className="highlightsImageSection">
                            <img src={img4} alt="Image" className="highlightsImage" />
                        </div>

                        <div className="highlightTextSection">
                            <div className="highlightSectionHeading">
                                Highlight Architectural Features
                            </div>
                            <div className="lightingSectionDescription">
                                Modern lighting isn't just about illumination, it's about storytelling. Use track or recessed lights to accentuate unique architectural features like textured walls, alcoves, or exposed beams. This not only draws attention to your space's personality but also creates a sophisticated look that's sure to impress.
                            </div>
                        </div>
                    </div>

                </div>

                {/* Smart Lighting Section */}

                <div className="highlightsBlogGroup">

                    <div className="highlightMainSectionTwo">
                        <div className="highlightTextSection">
                            <div className="highlightSectionHeading">
                                Embrace Smart Lighting for Convenience
                            </div>
                            <div className="lightingSectionDescription">
                                Integrating smart lighting systems into your space brings unmatched convenience and control. Adjust brightness, color temperature, or even schedule your lights, all with a simple tap on your smartphone or through voice commands. This modern solution saves energy, boosts security, and adapts to your lifestyle seamlessly.
                            </div>
                        </div>

                        <div className="highlightsImageSection">
                            <img src={img5} alt="Image" className="highlightsImage" />
                        </div>
                    </div>

                </div>

                {/* Statement Fixtures Sections */}

                {/* <div className="statementMainSection">

                    <div className="statementBorderSection">
                        <div className="blogRectangleImageSection">
                            <img src={img6} alt="Image" className="blogRectangleImage" />
                        </div>

                        <div className="statementTextSection">
                            <div className="rectangleSectionHeading">
                                Opt for Statement Fixtures
                            </div>
                            <div className="rectangleSectionDescription">
                                A striking light fixture can serve as the focal point of any room. Whether it's a dramatic chandelier, sleek pendant lights, or unique surface-adjustable luminaires, statement lighting pieces add character and elevate the overall design of your space. Choose designs that complement your décor style and reflect your personality. <br /> <br /> Elevate your space with Miro's modern lighting solutions, blending creativity and functionality. From tailored designs to energy-efficient fixtures, we bring innovation and beauty to every corner, let's light up your vision today!
                            </div>
                        </div>
                    </div>

                </div> */}

            </div>
        </>
    );
};

export default BlogDetails; 