import React from 'react';
import '../../css/blog-page2.css';

const Blog = () => {
    const blogs = Array.isArray(window.blogsData) ? window.blogsData : [];
    const firstBlog = blogs.length > 0 ? blogs[0] : null;
    const remainingBlogs = blogs.slice(1);

    const getImageUrl = (path) => {
        if (!path) return '';
        return `/storage/${path}`;
    };

    const getIntro = (text) => {
        if (!text) return '';
        return text.length > 220 ? `${text.slice(0, 220)}...` : text;
    };

    return (
        <div className="bl-blog-container">
            {firstBlog ? (
                <div className="bl-banner-flex">
                    <div className="bl-banner-text">
                        <h2 className="bl-banner-heading">{firstBlog.title}</h2>
                        <div className="bl-banner-border"></div>
                        <p className="bl-banner-description">{getIntro(firstBlog.intro)}</p>
                        <div className="bl-button-banner-flex">
                            <div className="bl-button-form-group">
                                <a href={`/blog/${firstBlog.slug}`} className="bl-banner-readmore">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                    <div className="bl-banner-img-div">
                        <img src={getImageUrl(firstBlog.feature_image)} alt={firstBlog.title} className="bl-banner-image" />
                    </div>
                </div>
            ) : (
                <div className="container py-5">
                    <p className="text-muted">No blogs found.</p>
                </div>
            )}

            {remainingBlogs.length > 0 && (
                <div className="bl-blog-card-group container">
                    {remainingBlogs.map((blog) => (
                        <div className="bl-blog-card" key={blog.id}>
                            <div className="bl-blog-card-img-div">
                                <img src={getImageUrl(blog.feature_image)} alt={blog.title} className="bl-blog-card-img" />
                            </div>
                            <div className="bl-blog-text">
                                <h2 className="bl-blog-heading">{blog.title}</h2>
                                <div className="bl-blog-border"></div>
                                <div className="bl-button-blog-flex">
                                    <div className="bl-button-form-group">
                                        <a href={`/blog/${blog.slug}`} className="bl-banner-readmore">
                                            Read More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            )}
        </div>
    );
};

export default Blog; 