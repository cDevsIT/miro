import React from 'react';
import ShareIcon from "../../../public/images/BLOG PAGE/SHARE ICON BLUE.svg";

const BlogDetails = ({ id }) => {
    const styles = {
        container: {
            maxWidth: '1920px',
            margin: '0 auto',
            padding: '80px 145px',
        },
        header: {
            marginBottom: '60px',
        },
        title: {
            textAlign: 'left',
            fontFamily: 'Segoe UI',
            fontSize: '32px',
            fontWeight: 'bold',
            lineHeight: '42px',
            letterSpacing: '0.88px',
            color: '#2D5586',
            marginBottom: '24px',
        },
        metadata: {
            display: 'flex',
            justifyContent: 'space-between',
            alignItems: 'center',
            borderBottom: '0.7px solid #c3c3c2',
            paddingBottom: '20px',
        },
        content: {
            fontFamily: 'Montserrat',
            fontSize: '18px',
            lineHeight: '40px',
            color: '#2D5586',
            letterSpacing: '0.58px',
        },
        shareImage: {
            width: '20px',
            height: '20px',
        },
        bannerImage: {
            width: '100%',
            height: 'auto',
            objectFit: 'cover',
            borderRadius: '15px',
            marginBottom: '60px',
        }
    };

    return (
        <div style={styles.container}>
            <div style={styles.header}>
                <h1 style={styles.title}>5 Ways to Elevate Your Space with Modern Lighting Solutions</h1>
                <div style={styles.metadata}>
                    <span>March 14, 2024</span>
                    <button style={{ background: 'none', border: 'none', cursor: 'pointer' }}>
                        <img src={ShareIcon} alt="Share" style={styles.shareImage} />
                    </button>
                </div>
            </div>

            <img 
                src="/images/BLOG PAGE/1ST BLOG/1ST BLOG DEFAULT.jpg"
                alt="Blog Featured Image" 
                style={styles.bannerImage}
            />

            <div style={styles.content}>
                <p>Transform your space with Miro's flawless installation, customized lighting, precision placement, and unmatched support for brilliance that lasts. Our expert team ensures every detail is perfect, from initial design to final implementation.</p>
                
                <p>Modern lighting solutions offer endless possibilities for enhancing your living or working space. Here are five innovative ways to transform your environment:</p>

                <h2>1. Layer Your Lighting</h2>
                <p>Create depth and dimension by combining ambient, task, and accent lighting. This approach ensures both functionality and aesthetics, allowing you to adjust the atmosphere according to different activities and times of day.</p>

                <h2>2. Smart Integration</h2>
                <p>Incorporate smart lighting systems that allow you to control brightness, color temperature, and scheduling from your mobile device. This not only adds convenience but also helps in energy conservation.</p>

                {/* Add more content as needed */}
            </div>
        </div>
    );
};

export default BlogDetails; 