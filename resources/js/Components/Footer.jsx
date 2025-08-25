import React from 'react';
import { Link } from 'react-router-dom';

import logoWhite from '../../../public/images/miro-logo-white.png';
import FacebookIcon from '../../icons/facebook';
import InstagramIcon from '../../icons/instagram';
import LinkedInIcon from '../../icons/linkedin';
import PhoneIcon from '../../icons/phone';
import EmailIcon from '../../icons/email';
const Footer = () => {
    return (
        <footer class="footer">
        <div class="footer-content container">
          <div class="footer-left">
            <div class="footer-logo">
              <img src={logoWhite} alt="Miro" />
            </div>

            <div class="footer-contact-info">
                <span>Contact us:</span>
              <p> <PhoneIcon /> +8801786-711975</p>
              <p> <EmailIcon /> info@miro-lightingsolutions.com</p>
            </div>

            <div class="footer-custom-links">
              <a href="/products">Products</a>
              <a href="/projects">Projects</a>
              <a href="/services">Service</a>
              <a href="/blog">Blog</a>
            </div>

            <div class="footer-contact-info-mobile">
                <span>Contact Us:</span>
              <p> <PhoneIcon /> +8801786-711975</p>
              <p> <EmailIcon /> info@miro-lightingsolutions.com</p>
            </div>

            <div class="footer-social">
                <span>Follow us on:</span>
                <div class="footer-social-icons">
                <a class='footer-social-icon' href="https://www.facebook.com/profile.php?id=61567219780240" target="_blank">
                <FacebookIcon />
              </a>
                <a class='footer-social-icon' href="https://www.instagram.com/mirolightco?igsh=MTJkdTVxNzc1czB2dA==" target="_blank">
                <InstagramIcon />
                </a>
                <a class='footer-social-icon' href="https://www.linkedin.com/company/miro-lightingsolutions/?viewAsMember=true" target="_blank">
                <LinkedInIcon />
                </a>
                </div>
            </div>
          </div>


          <div class="footer-right">
            <div class="footer-custom-links">
              <a href="/products">Products</a>
              <a href="/projects">Projects</a>
              <a href="/services">Service</a>
              <a href="/blog">Blog</a>
            </div>

            <div class="footer-social">
                <span>Follow us on:</span>
                <div class="footer-social-icons">
                <a class='footer-social-icon' href="https://www.facebook.com/profile.php?id=61567219780240" target="_blank">
                <FacebookIcon />
              </a>
                <a class='footer-social-icon' href="https://www.instagram.com/mirolightco?igsh=MTJkdTVxNzc1czB2dA==" target="_blank">
                <InstagramIcon />
                </a>
                <a class='footer-social-icon' href="https://www.linkedin.com/company/miro-lightingsolutions/?viewAsMember=true" target="_blank">
                <LinkedInIcon />
                </a>
                </div>
            </div>
          </div>
          
        </div>

        <div class="footer-bottom container">
        <span>© 2024 All Rights Reserved</span>
          <div class="footer-bottom-links">
            <span>|</span>
            <a href="#">Terms & Conditions</a>
            <span>|</span>
            <a href="#">Privacy Policy</a>
          </div>
        </div>
      </footer>
    );
};

export default Footer; 