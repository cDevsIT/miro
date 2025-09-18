import React, { useState, useEffect, useRef } from 'react';
import { Link, useLocation } from 'react-router-dom';

import logo from '../../../public/images/miro-logo.png';
import contactIcon from '../../../public/images/icons/icon-contact.png';
import myMiroIcon from '../../../public/images/icons/my-miro.png';
import wishlistIcon from '../../../public/images/icons/WISHLIST_TWO.svg'
import boqIcon from '../../../public/images/icons/BOQ.svg'
import searchIcon from '../../../public/images/icons/search.png';
import HamBurger from '../../icons/ham-burger';
import axios from 'axios';
import Wishlist from './MyMiro/Wishlist';
import { useAuth } from '@/hooks/useAuth';
import { useWishlist } from '../contexts/WishlistContext';

const Header = () => {
    const { isAuthenticated } = useAuth();
    const { getWishlistCount } = useWishlist();
    const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);
    const [isProductsDropdownOpen, setIsProductsDropdownOpen] = useState(false);
    const [isSearchOpen, setIsSearchOpen] = useState(false);
    const [isFocused, setIsFocused] = useState(false);
    const [inputValue, setInputValue] = useState('');
    const [searchResults, setSearchResults] = useState([]);
    const [showDropdown, setShowDropdown] = useState(false);
    const searchTimeout = useRef(null);
    const desktopSearchRef = useRef(null);
    const mobileSearchRef = useRef(null);
    const location = useLocation();

    const handleFocus = () => {
        setIsFocused(true);
    }

    const handleBlur = () => {
        setIsFocused(false);
    }

    const handleInputChange = (event) => {
        setInputValue(event.target.value);
        if (searchTimeout.current) clearTimeout(searchTimeout.current);
        const value = event.target.value;
        if (value.length === 0) {
            setSearchResults([]);
            setShowDropdown(false);
            return;
        }
        searchTimeout.current = setTimeout(async () => {
            try {
                const res = await axios.get(`/api/products/search?q=${encodeURIComponent(value)}`);
                setSearchResults(res.data);
                setShowDropdown(true);
            } catch (err) {
                setSearchResults([]);
                setShowDropdown(false);
            }
        }, 300);
    };

    const getPathClassName = () => {
        if (location.pathname === '/services') {
            return 'services-path';
        } else if (location.pathname === '/projects' || location.pathname === '/projects/1') {
            return 'project-path';
        } else {
            return '';
        }
    };

    const pathClassName = getPathClassName();

    useEffect(() => {
        const handleClickOutside = (event) => {
            const isInDesktop = desktopSearchRef.current && desktopSearchRef.current.contains(event.target);
            const isInMobile = mobileSearchRef.current && mobileSearchRef.current.contains(event.target);
            if (!isInDesktop && !isInMobile) {
                setIsSearchOpen(false);
                setInputValue('');
                setIsFocused(false);
                setShowDropdown(false);
            }
        };

        document.addEventListener('mousedown', handleClickOutside);
        return () => {
            document.removeEventListener('mousedown', handleClickOutside);
        };
    }, []);

    return (
        <header class="header-container">
            <div class="header-container-bg">
                <nav class="header-nav-desktop container">

                    <a href="/" class="header-logo-link">
                        <img class="header-logo" src={logo} alt="Miro" />
                    </a>

                    {/* Desktop Navigation */}
                    <div class="header-nav-links">
                        <ul>
                            <li class="products-dropdown">
                                <a href="#" class="header-nav-link" onClick={() => setIsProductsDropdownOpen(!isProductsDropdownOpen)}>
                                    Products
                                    <span class={`triangle_down ${isProductsDropdownOpen ? 'active' : ''}`}></span>
                                </a>
                                {isProductsDropdownOpen && (
                                    <ul class="sub-menu">
                                        <li><a href="/products/category/indoor">Indoor Products</a></li>
                                        <li><a href="/products/category/outdoor">Outdoor Products</a></li>
                                    </ul>
                                )}
                            </li>
                            <li>
                                <a href="/projects" class="header-nav-link">Projects</a>
                            </li>
                            <li>
                                <a href="/services" class="header-nav-link">Services</a>
                            </li>
                            <li>
                                <a href="/blog" class="header-nav-link">Blog</a>
                            </li>

                        </ul>
                    </div>

                    {/* Desktop Icons */}
                    <div class="header-nav-icons">
                        {isAuthenticated ?
                            <div className="wishlist-icon-container">
                                <img class="header-icon" src={wishlistIcon} alt="WishlistIcon" />
                                {getWishlistCount() > 0 && (
                                    <span className="wishlist-badge">{getWishlistCount()}</span>
                                )}
                            </div>
                            :
                            <a href="/contact">
                                <img class="header-icon" src={contactIcon} alt="Contact" />
                            </a>
                        }
                        

                        {isAuthenticated ?
                            <a href="/mymiro">
                                <img class="header-icon" src={boqIcon} alt="My Miro" />
                            </a>
                            :
                            <a href="/mymiro">
                                <img class="header-icon" src={myMiroIcon} alt="My Miro" />
                            </a>
                        }


                        <div class="header-search-icon-container">
                            <div class="header-search-icon" onClick={() => setIsSearchOpen(!isSearchOpen)}>
                                <img class="header-icon" src={searchIcon} alt="Search" />
                            </div>
                            {isSearchOpen && (
                                <div
                                    ref={desktopSearchRef}
                                    className={`header-search-input-container ${pathClassName}`}
                                >
                                    {!(isFocused || inputValue) && (
                                        <div className="header-search-input-placeholder">
                                            <img className="header-icon" src={searchIcon} alt="Search" />
                                            <span>Search</span>
                                        </div>
                                    )}
                                    <input
                                        onFocus={handleFocus}
                                        onBlur={handleBlur}
                                        onChange={handleInputChange}
                                        value={inputValue}
                                        type="text"
                                        className="header-search-input"
                                        autoComplete="off"
                                        name="search"
                                    />
                                    {showDropdown && searchResults.length > 0 && (
                                        <div className="search-dropdown-modal">
                                            {searchResults.map(product => (
                                                <a
                                                    key={product.id}
                                                    href={`/products/${product.model_number}`}
                                                    className="search-dropdown-item"
                                                    onClick={() => {
                                                        setShowDropdown(false);
                                                        setIsSearchOpen(false);
                                                        setInputValue('');
                                                    }}
                                                >
                                                    <img src={`/storage/${product.thumbnail}`} alt={product.name} className="search-dropdown-thumb" />
                                                    <span className="search-dropdown-model">{product.model_number}</span>

                                                </a>
                                            ))}
                                        </div>
                                    )}
                                </div>
                            )}
                        </div>
                    </div>

                    {/* Mobile Icons */}
                    <div class="header-mobile-icons">
                        <div class="header-search-icon" onClick={() => setIsSearchOpen(!isSearchOpen)}>
                            <img class="header-icon" src={searchIcon} alt="Search" />
                        </div>
                        {isSearchOpen && (
                            <div
                                ref={mobileSearchRef}
                                className={`header-search-input-container ${pathClassName}`}
                            >
                                {!(isFocused || inputValue) && (
                                    <div className="header-search-input-placeholder">
                                        <img className="header-icon" src={searchIcon} alt="Search" />
                                        <span>Search</span>
                                    </div>
                                )}
                                <input
                                    onFocus={handleFocus}
                                    onBlur={handleBlur}
                                    onChange={handleInputChange}
                                    value={inputValue}
                                    type="text"
                                    className="header-search-input"
                                    autoComplete="off"
                                    name="Search"
                                />
                                {showDropdown && searchResults.length > 0 && (
                                    <div className="search-dropdown-modal">
                                        {searchResults.map(product => (
                                            <a
                                                key={product.id}
                                                href={`/products/${product.model_number}`}
                                                className="search-dropdown-item"
                                                onClick={() => {
                                                    setShowDropdown(false);
                                                    setIsSearchOpen(false);
                                                    setInputValue('');
                                                }}
                                            >
                                                <img src={product.thumbnail ? `/storage/${product.thumbnail}` : '/images/miro-logo.png'} alt={product.model_number} className="search-dropdown-thumb" />
                                                <span className="search-dropdown-model">{product.model_number}</span>
                                                <span className="search-dropdown-name">{product.name}</span>
                                            </a>
                                        ))}
                                    </div>
                                )}
                            </div>
                        )}

                        <button class="header-menu-button" onClick={() => setIsMobileMenuOpen(!isMobileMenuOpen)}>
                            <HamBurger />
                        </button>
                    </div>
                </nav>

                {/* Mobile Menu */}
                {isMobileMenuOpen && (
                    <div class="header-mobile-menu">
                        <div class="header-mobile-top">
                            <a href="/">
                                <img class="header-logo" src={logo} alt="Miro" />
                            </a>
                            <button class="header-close-button" onClick={() => setIsMobileMenuOpen(false)}>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6 6 18" />
                                    <path d="m6 6 12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="header-mobile-nav">
                            <div class="header-mobile-links">
                                <ul>
                                    <li class="products-dropdown">
                                        <a href="#" class="header-nav-link" onClick={() => setIsProductsDropdownOpen(!isProductsDropdownOpen)}>
                                            Products
                                            <span class={`triangle_down ${isProductsDropdownOpen ? 'active' : ''}`}></span>
                                        </a>
                                        {isProductsDropdownOpen && (
                                            <ul class="sub-menu">
                                                <li><a href="/products/category/indoor">Indoor Products</a></li>
                                                <li><a href="/products/category/outdoor">Outdoor Products</a></li>
                                            </ul>
                                        )}
                                    </li>
                                    <li>
                                        <a href="/projects" class="header-nav-link">Projects</a>
                                    </li>
                                    <li>
                                        <a href="/services" class="header-nav-link">Services</a>
                                    </li>
                                    <li>
                                        <a href="/blog" class="header-nav-link">Blog</a>
                                    </li>
                                    <li>
                                        <a href="/about-us" class="header-nav-link">About Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="header-mobile-contact">
                            <div class="header-contact-items">
                                <div class="header-contact-item">
                                    <a href="tel:+8801786711975">
                                        <img class="header-icon" src={contactIcon} alt="Contact" />
                                        <span>+8801786-711975</span>
                                    </a>
                                </div>
                                <div class="header-contact-item">
                                    <a href="/mymiro">
                                        <img class="header-icon" src={myMiroIcon} alt="My Miro" />
                                        <span>my.miro</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="header-mobile-social">
                            <div class="header-social-icons">
                                <svg class="header-social-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                </svg>
                                <svg class="header-social-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z" />
                                </svg>
                                <svg class="header-social-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5" />
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                    <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
                                </svg>
                            </div>
                        </div>
                    </div>
                )}
                {/* <script>
                    document.addEventListener('DOMContentLoaded', () => {
                    const menuButton = document.querySelector('.header-menu-button');
                    const closeButton = document.querySelector('.header-close-button');
                    const mobileMenu = document.querySelector('.header-mobile-menu');

                    const toggleMenu = () => {
                        mobileMenu.classList.toggle('active');
                        document.body.classList.toggle('menu-open');
                    };

                    menuButton.addEventListener('click', toggleMenu);
                    closeButton.addEventListener('click', toggleMenu);

                    // Products dropdown functionality
                    const productsDropdown = document.querySelector('.products-dropdown');
                    const dropdownLink = productsDropdown.querySelector('.header-nav-link');
                    const subMenu = productsDropdown.querySelector('.sub-menu');
                    const triangleDown = productsDropdown.querySelector('.triangle_down');
                    dropdownLink.addEventListener('click', (e) => {
                        e.preventDefault();
                        subMenu.classList.toggle('active');
                        triangleDown.classList.toggle('active');
                    });

                    // Close dropdown when clicking outside
                    document.addEventListener('click', (e) => {
                        if (!productsDropdown.contains(e.target)) {
                        subMenu.classList.remove('active');
                        triangleDown.classList.remove('active');
                        }
                    });

                    // Close menu when clicking on a link
                    const mobileLinks = document.querySelectorAll('.header-mobile-link');
                    mobileLinks.forEach(link => {
                        link.addEventListener('click', toggleMenu);
                    });
                    });
                </script> */}
            </div>
        </header>
    );
};

export default Header; 