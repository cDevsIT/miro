import React from 'react';
import '../../css/product-blog.css';
import img1 from '../../../public/images/product-blog/blog-main-pic.jpg';
import img2 from '../../../public/images/product-blog/blog-img-2.jpg';
import img3 from '../../../public/images/product-blog/blog-img-3.jpg';
import img4 from '../../../public/images/product-blog/blog-img-4.jpg';
import img5 from '../../../public/images/product-blog/blog-img-5.jpg';
import img6 from '../../../public/images/product-blog/blog-img-6.jpg';

const ProductBlog = () => {
    return (
        <>
            {/* Section-1 for THE Banner and Details Part */}
            <div className="services-container single-product-holder">
                <div className='single-product-blog'>
                    <a href='/products/category/indoor'>Indoor Products</a> <span className='breadcrumb-slash'>/</span> <a className='breadcrumb-last' href='/products/category-details/9'>LED Recessed Luminaire</a>
                </div>
                <div className="services-image-container">
                    <img src={img1} alt="Service Image" className="service-image" />
                </div>
                <div className="service-content">
                    <div className="content-center container blog-product-text">
                        <div className="service-heading privacy-heading-shorter">
                            <p className='service-heading-description' > Minimal Form. Maximum Atmosphere </p>
                            <h1>Recessed Lighting That Elevates Every Room.</h1>
                        </div>
                        <div className="service-description">
                            <p>The Miro Recessed Adjustable Ceiling Luminaire isn’t just another light fixture, it’s a versatile solution designed to fit seamlessly into modern spaces. Whether it’s an office, a retail store, or a common area, Miro adapts beautifully.

                            With multiple lumen options, cut-out sizes, and color temperatures, it offers customized lighting that complements both form and function. Its adjustable design allows users to shape light exactly where they need it, enhancing both ambiance and efficiency. It’s lighting that blends in while standing out, elevating everyday environments with thoughtful precision</p>
                        </div>
                    </div>
                    <div className="privacy-line"></div>
                </div>
            </div>

            {/* Section-2 for Picture and Text Details from Blog Details Page */}
            <div className='picture-text-blog-product' >
                <div className="pictureDiv">
                    <img src={img2} alt="Service Image" className="detailsBannerImage" />
                </div>

                <div className="detailsImage">
                    <div className="detailsHeadingImage">
                        Benefits of Recessed Lighting
                    </div>
                    <div className="detailsDescriptionImage">
                        When it comes to lighting that blends effortlessly into a space while delivering top-tier performance, the Miro Recessed Adjustable Ceiling Luminaire stands out. Its compact, minimal design makes it an ideal fit for any modern interior—offices, retail, or communal areas—without compromising on style. What truly sets it apart is its advanced lighting technology, engineered to provide soft, comfortable illumination while maintaining high energy efficiency. This means brighter spaces, lower power bills, and a lighting experience that feels as good as it looks. It’s built to last, designed to impress, and tailored to perform in every setting.
                    </div>
                </div>
            </div>

            {/* Section-3 for Image and Text from Blog Details */}
            <div className='fit-shine-box' >

                <div className="fitShine-text-box">
                    <div className="text-fitShine">
                        <h2> Designed to Fit. Built to Shine </h2>
                        <p>Designed with longevity and reliability in mind, the Miro Recessed Adjustable Ceiling Luminaire is built to perform. It features a specially engineered LED driver that maximizes energy efficiency and extends the fixture’s lifespan—delivering consistent, flicker-free illumination while keeping power consumption low. Its sturdy construction makes it perfect for high-traffic environments, ensuring durability without compromising on style. Combined with exceptional visual comfort and adaptable functionality, this luminaire is a smart, sustainable choice for commercial, retail, and everyday spaces where quality lighting truly matters.</p>
                    </div>
                </div>
                <div className="fitShine-image-box">
                    <img src={img3} alt="Image for Fit and Shine of Miro" />
                </div>
                <div className="fitShine-gap-box"></div>

            </div>

            {/* Section-4 for Picture and Text Details from Blog Details Page */}
            <div className='picture-text-blog-product' >
                <div className="pictureDiv featurePicture">
                    <img src={img4} alt="Service Image" className="detailsBannerImage" />
                </div>

                <div className="detailsImage featuresText">
                    <div className="detailsHeadingImage">
                        Features
                    </div>
                    <div className="detailsDescriptionImage">
                        Miro Lighting SolMiro Lighting Solutions brings together innovation and design, creating lighting that’s both advanced and beautifully crafted. With a high Color Rendering Index (CRI), their luminaires bring out the truest tones—ideal for showcasing art, enhancing retail displays, or simply bringing warmth and clarity to home interiors. Powered by premium LED chips, Miro lights offer brilliant, energy-efficient illumination while keeping operational costs low. It’s lighting that not only performs beautifully but feels effortlessly refined.
                    </div>
                </div>
            </div>

            {/* Section-5 for Image and Text from Blog Details */}
            <div className='fit-shine-box lighting-adapt' >

                <div className="fitShine-text-box">
                    <div className="text-fitShine">
                        <h2> Lighting that adapts to your needs </h2>
                        <p>Miro’s lighting fixtures are designed with versatility in mind, giving users the freedom to direct light exactly where it’s needed—whether it’s highlighting artwork, setting the mood, or illuminating a workspace. With adjustable angles and a dimmable feature, they offer complete control over brightness, effortlessly shifting from a soft, ambient glow to a focused beam for task lighting.</p>
                    </div>
                </div>
                <div className="fitShine-image-box lighting-adapt-img-box">
                    <img src={img5} alt="Image for Fit and Shine of Miro" />
                </div>
                <div className="fitShine-gap-box"></div>

            </div>

            {/* Section-6 for Picture and Text Details from Blog Details Page */}
            <div className='picture-text-blog-product' >
                <div className="pictureDiv featurePicture">
                    <img src={img6} alt="Service Image" className="detailsBannerImage" />
                </div>

                <div className="detailsImage featuresText">
                    <div className="detailsHeadingImage">
                        Light at your command—anytime, anywhere
                    </div>
                    <div className="detailsDescriptionImage">
                        Miro brings lighting into the future with smart connectivity, effortlessly integrating into existing smart home systems. With app control, voice commands, and automation, users can adjust their lighting with ease—whether setting the perfect mood, scheduling brightness levels, or controlling lights remotely. It’s all about convenience, efficiency, and a seamless modern living experience.
                    </div>
                </div>
            </div>
        </>
    );
};

export default ProductBlog; 