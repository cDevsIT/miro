import React, { forwardRef } from 'react';
import Facebook from "../../../public/images/icons/fb.svg";
import Instagram from "../../../public/images/icons/insta.svg";
import LinkedInIcon from "../../../public/images/icons/linkedin.svg";
import '../../css/share-tooltip.css';

const ShareTooltip = forwardRef(({ show, position, onClose }, ref) => {
    const tooltipStyle = {
        left: `${position.x + 50}px`,
        top: `${position.y}px`,
        transform: 'translateX(-50%)',
    };

    const handleSocialIconClick = (e, platform) => {
        e.stopPropagation();
        const shareUrl = encodeURIComponent(window.location.href);
        const url = window.location.href;

        if (platform === 'Facebook') {
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${shareUrl}`, '_blank', 'noopener,noreferrer');
        } else if (platform === 'LinkedIn') {
            window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${shareUrl}`, '_blank', 'noopener,noreferrer');
        } else if (platform === 'Instagram') {
            window.open('https://www.instagram.com/', '_blank', 'noopener,noreferrer');
        }
        onClose();
    };

    const handleTooltipClick = (e) => {
        e.stopPropagation();
    };

    return (
        <div
            ref={ref}
            className={`share-tooltip-container ${show ? 'share-tooltip-show' : ''}`}
            style={tooltipStyle}
            onClick={handleTooltipClick}
        >
            {/* Arrow */}
            <div className="share-tooltip-arrow"></div>

            {/* Tooltip Content */}
            <div className="share-tooltip-content">
                <div className="share-tooltip-header">
                    <span>Share via:</span>
                </div>

                <div className="share-tooltip-social-icons">
                    <button 
                        className="share-tooltip-social-button share-tooltip-facebook"
                        onClick={(e) => handleSocialIconClick(e, 'Facebook')}
                    >
                        <img src={Facebook} alt="Facebook" className="share-tooltip-social-icon " />
                    </button>

                    <button 
                        className="share-tooltip-social-button share-tooltip-instagram"
                        onClick={(e) => handleSocialIconClick(e, 'Instagram')}
                    >
                        <img src={Instagram} alt="Instagram" className="share-tooltip-social-icon" />
                    </button>

                    <button 
                        className="share-tooltip-social-button share-tooltip-linkedin"
                        onClick={(e) => handleSocialIconClick(e, 'LinkedIn')}
                    >
                        <img src={LinkedInIcon} alt="LinkedIn" className="share-tooltip-social-icon" />
                    </button>
                </div>
            </div>
        </div>
    );
});

ShareTooltip.displayName = 'ShareTooltip';

export default ShareTooltip;