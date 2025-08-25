import React from 'react';
import img1 from "../../../public/images/BLOG PAGE/1ST BLOG/1ST BLOG DEFAULT.jpg";
import img2 from "../../../public/images/BLOG PAGE/2ND BLOG/2ND BLOG PICTURE DEFAULT .jpg";
import img3 from "../../../public/images/BLOG PAGE/3RD BLOG/3RD BLOG PICTURE DEFAULT.jpg";
import img1Hover from "../../../public/images/BLOG PAGE/1ST BLOG/1ST BLOG HOVER.jpg";
import ShareIcon from "../../../public/images/BLOG PAGE/SHARE ICON BLUE.svg";
import '../../css/blog-page2.css';

const Blog = () => {
    return (
        <div className="bl-blog-container">
            {/* First Section - Banner */}
            <div className="bl-banner-flex">
                <div className="bl-banner-text">
                    <h2 className="bl-banner-heading">5 Ways to Elevate Your Space with Modern Lighting Solutions</h2>
                    <div className="bl-banner-border"></div>
                    <p className="bl-banner-description">
                        Transform your space with Miro's flawless installation, customized lighting, precision placement, and unmatched support for brilliance that lasts.
                    </p>
                    <div className="bl-button-banner-flex">
                        <div className="bl-button-form-group">
                            <a 
                                href="/blog/1"
                                className="bl-banner-readmore"
                            >
                                Read More
                            </a>
                        </div>
                        <button type="button" className="bl-button-share">
                            <img src={ShareIcon} alt="Share Button" className="bl-share-image" />
                        </button>
                    </div>
                </div>
                <div className="bl-banner-img-div">
                    <img src={img1} alt="Blog 1 Image" className="bl-banner-image" />
                </div>
            </div>

            {/* Second Section - Blog Cards */}
            <div className="bl-blog-card-group container">
                <div className="bl-blog-card">
                    <div className="bl-blog-card-img-div">
                        <img src={img2} alt="Blog Card Image" className="bl-blog-card-img" />
                    </div>
                    <div className="bl-blog-text">
                        <h2 className="bl-blog-heading">The Miro Light Installation Experience: Bringing You Vision to Life</h2>
                        <div className="bl-blog-border"></div>
                        <div className="bl-button-blog-flex">
                            <div className="bl-button-form-group">
                                <a 
                                    href="/installation"
                                    className="bl-banner-readmore"
                                >
                                    Read More
                                </a>
                            </div>
                            <button type="button" className="bl-button-share">
                                <img src={ShareIcon} alt="Share Button" className="bl-share-image" />
                            </button>
                        </div>
                    </div>
                </div>

                <div className="bl-blog-card">
                    <div className="bl-blog-card-img-div">
                        <img src={img3} alt="Blog Card Image" className="bl-blog-card-img" />
                    </div>
                    <div className="bl-blog-text">
                        <h2 className="bl-blog-heading">The Hidden Impact of High CRI Lighting</h2>
                        <div className="bl-blog-border"></div>
                        <div className="bl-button-blog-flex">
                            <div className="bl-button-form-group">
                                <a 
                                    href="/blog/3"
                                    className="bl-banner-readmore"
                                >
                                    Read More
                                </a>
                            </div>
                            <button type="button" className="bl-button-share">
                                <img src={ShareIcon} alt="Share Button" className="bl-share-image" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {/* Third Section - Dummy Blog Banner */}
            <div className="bl-dummy-blog-group container">
                <div className="bl-dummy-banner-flex">
                    <div className="bl-dummy-banner-text">
                        <h2 className="bl-banner-heading">Title</h2>
                        <div className="bl-banner-border"></div>
                        <div className="bl-banner-description">
                            Bio
                        </div>
                        <div className="bl-button-banner-flex">
                            <div className="bl-button-form-group">
                                <a 
                                    href="/blog/4"
                                    className="bl-banner-readmore"
                                >
                                    Read More
                                </a>
                            </div>
                            <button type="button" className="bl-button-share">
                                <img src={ShareIcon} alt="Share Button" className="bl-share-image" />
                            </button>
                        </div>
                    </div>
                    <div className="bl-dummy-banner-img-div"></div>
                </div>
            </div>

            {/* Fourth Section - Dummy Blog Cards */}
            <div className="bl-blog-card-group bl-dummy-blog-card-group container">
                <div className="bl-blog-card">
                    <div className="bl-blog-card-img-div">
                        <img src={img2} alt="Blog Card Image" className="bl-blog-card-img" />
                    </div>
                    <div className="bl-blog-text">
                        <h2 className="bl-blog-heading">The Miro Light Installation Experience: Bringing You Vision to Life</h2>
                        <div className="bl-blog-border"></div>
                        <div className="bl-button-blog-flex">
                            <div className="bl-button-form-group">
                                <a 
                                    href="/installation"
                                    className="bl-banner-readmore"
                                >
                                    Read More
                                </a>
                            </div>
                            <button type="button" className="bl-button-share">
                                <img src={ShareIcon} alt="Share Button" className="bl-share-image" />
                            </button>
                        </div>
                    </div>
                </div>

                <div className="bl-blog-card">
                    <div className="bl-blog-card-img-div">
                        <img src={img3} alt="Blog Card Image" className="bl-blog-card-img" />
                    </div>
                    <div className="bl-blog-text">
                        <h2 className="bl-blog-heading">The Hidden Impact of High CRI Lighting</h2>
                        <div className="bl-blog-border"></div>
                        <div className="bl-button-blog-flex">
                            <div className="bl-button-form-group">
                                <a 
                                    href="/blog/3"
                                    className="bl-banner-readmore"
                                >
                                    Read More
                                </a>
                            </div>
                            <button type="button" className="bl-button-share">
                                <img src={ShareIcon} alt="Share Button" className="bl-share-image" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Blog; 