import React, { useState, useEffect, useRef } from 'react';
import axios from 'axios';
import '../../../css/mymiro.css'
import { CiMenuBurger } from "react-icons/ci";
import MeetingSchedule from './MeetingSchedule';
import MyAccount from './MyAccount';
import GetQuote from './GetQuote';
import Wishlist from './Wishlist';
import BookAppointment from './BookAppointment';
import EditProfile from './EditProfile';
import ChangePassword from './ChangePassword';
import Notifications from './Notifications';
import PrivacyData from './PrivacyData';
import { MdArrowBackIosNew } from "react-icons/md";
import OverviewIcon from '../../../icons/Overview-icon';
import MyAccountIcon from '../../../icons/MyAccount-icon';
import WishlistIcon from '../../../icons/Wishlist-icon';
import GetAQuotationIcon from '../../../icons/get-a-quotation';
import MeetingIcon from '../../../icons/Meeting-icon';
import SettingsIcon from '../../../icons/Settings-icon';
import LogoutIcon from '../../../icons/Logout-icon';
import HamBurger from '../../../icons/ham-burger';
import { CiLock } from "react-icons/ci";
import { GoBell } from "react-icons/go";
import { GrNotes } from "react-icons/gr";
import { BsPersonCircle } from "react-icons/bs";
import { IoSettingsOutline } from "react-icons/io5";
import { FaRegHeart } from "react-icons/fa";
import { CiPower } from "react-icons/ci";
import { FaRegFileAlt } from "react-icons/fa";

const MyMiro = () => {
    const [customer, setCustomer] = useState(null);
    const [isMenuCollapsed, setIsMenuCollapsed] = useState(false);
    const [activeTab, setActiveTab] = useState('overview');
    const [isProfileDropdownOpen, setIsProfileDropdownOpen] = useState(false);
    const [loading, setLoading] = useState(true);
    const [showSettingsTabs, setShowSettingsTabs] = useState(false);
    const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);

    const dropdownRef = useRef(null);
    const profileDropdownRef = useRef(null);

    // Check for activeTab in localStorage on component mount
    useEffect(() => {
        const savedTab = localStorage.getItem('mymiroActiveTab');
        if (savedTab) {
            setActiveTab(savedTab);
            // Clear the saved tab after using it
            localStorage.removeItem('mymiroActiveTab');
        }
    }, []);

    // Close the dropdown if clicked outside
    useEffect(() => {
        const handleClickOutside = (event) => {
            if (
                dropdownRef.current &&
                !dropdownRef.current.contains(event.target) &&  // If the click is outside the dropdown
                !profileDropdownRef.current.contains(event.target) // and outside the profile dropdown button
            ) {
                setIsProfileDropdownOpen(false);  // Close the dropdown
            }
        };

        document.addEventListener('click', handleClickOutside);

        // Clean up the event listener when the component is unmounted
        return () => {
            document.removeEventListener('click', handleClickOutside);
        };
    }, []);

    // Close dropdown when page/tab changes
    useEffect(() => {
        setIsProfileDropdownOpen(false);  // Close dropdown when activeTab changes
    }, [activeTab]);  // Re-run effect when activeTab changes

    const handleSettingsClick = () => {
        if (showSettingsTabs) {
            setActiveTab('overview');
        } else {
            setActiveTab('editProfile');
        }

        setShowSettingsTabs(!showSettingsTabs);
    };

    useEffect(() => {
        const fetchCustomerData = async () => {
            try {
                const response = await axios.get('/mymiro/customer-data');
                setCustomer(response.data.customer);
            } catch (error) {
                console.error('Error fetching customer data:', error);
            } finally {
                setLoading(false);
            }
        };

        fetchCustomerData();
    }, []);

    const handleLogout = async () => {
        try {
            await axios.post('/mymiro/logout');
            window.location.href = '/mymiro/login';
        } catch (error) {
            console.error('Error logging out:', error);
        }
    };

    const renderContent = () => {
        switch (activeTab) {
            case 'overview':
                return (
                    <div className="content-grid">

                        <div className='overview-mobile-data' >
                            <div className='menu-name-mobile' >
                                <h2> Overview </h2>
                            </div>
                        </div>

                        <div className="content-card">
                            <h2>My Account</h2>
                            <div className="account-info">
                                <p>{customer?.name}</p>
                                <p>{customer?.email}</p>
                                <p>{customer?.phone}</p>
                            </div>
                            <div className="action-links">
                                <a href="#" className="action-links-button"
                                    onClick={() => {
                                        setActiveTab('myAccount');
                                    }}>
                                    View
                                    <span className='action-link-underline'></span>
                                </a>
                                <a href="#" className="action-links-button"
                                    onClick={() => {
                                        setActiveTab('editProfile');
                                        setShowSettingsTabs(true);
                                    }}
                                >
                                    Edit
                                    <span className='action-link-underline'></span>
                                </a>
                            </div>
                        </div>

                        <div className="content-card">
                            <h2>Wishlist</h2>
                            <div className="empty-state">
                                <p className='empty-state-subtitle'>No wishlist items</p>
                                <p>Take a look at our products &</p>
                                <p>add items to your wishlist!</p>
                            </div>
                            <div className='action-links'>
                            <a href="#" className="action-links-button"
                                onClick={() => {
                                    setActiveTab('wishlist');
                                }}
                            >
                                View products
                                <span className='action-link-underline'></span>
                            </a>
                            </div>
                        </div>

                        <div className="content-card">
                            <h2>Get a Quote</h2>
                            <div className="empty-state">
                                <p className='empty-state-subtitle'>No quote requested</p>
                                <p>explore our products</p>
                                <p>& get your quote for your project</p>
                            </div>
                            <div className='action-links'>
                            <a href="#" className="action-links-button"
                                onClick={() => {
                                    setActiveTab('getQuote');
                                }}
                            >
                                Build your BOQ
                                <span className='action-link-underline'></span>
                            </a>
                            </div>
                        </div>

                        <div className="content-card">
                            <h2>Meeting Schedule</h2>
                            <div className="empty-state">
                                <p className='empty-state-subtitle'>No meetings scheduled</p>
                                <p>You have no upcoming meetings</p>
                                <p>& get your quote for your project</p>
                            </div>
                            <div className='action-links'>
                            <button
                                className="action-links-button"
                                onClick={() => setActiveTab('meetingSchedule')}
                            >
                                Schedule your Meeting
                                <span className='action-link-underline'></span>
                            </button>
                            </div>
                        </div>
                    </div>
                );
            case 'myAccount':
                return <MyAccount customer={customer} setActiveTab={setActiveTab} setShowSettingsTabs={setShowSettingsTabs} />;
            case 'wishlist':
                return <Wishlist />;
            case 'getQuote':
                return <GetQuote setActiveTab={setActiveTab} />;
            case 'meetingSchedule':
                return <MeetingSchedule setActiveTab={setActiveTab} />;
            case 'bookAppointment':
                return <BookAppointment setActiveTab={setActiveTab} />;
            case 'editProfile':
                return <EditProfile customer={customer} />;
            case 'changePassword':
                return <ChangePassword />;
            case 'notifications':
                return <Notifications />;
            case 'privacyData':
                return <PrivacyData />;
            default:
                return null;
        }
    };

    if (loading) return <div className="loading">Loading...</div>;

    return (
        <div className="mymiro-dashboard">
            {/* Top Bar */}
            <div className="top-bar">
                <div
                    ref={profileDropdownRef}
                    className="profile-dropdown"
                    onClick={() => setIsProfileDropdownOpen(!isProfileDropdownOpen)}
                >
                    <span className='profile-dropdown_name'>{customer?.name}</span>
                    <div className={`profile-dropdown_triangle_down ${isProfileDropdownOpen ? ' open' : ''} `} ></div>
                </div>
                <div ref={dropdownRef} className={`dropdown-box  ${isProfileDropdownOpen ? ' open' : ''} `} >

                    <button className="topBar-nav-item" onClick={() => setActiveTab('myAccount')}>
                        <MyAccountIcon />
                        <span className={`topBar-nav-text`}>My Account</span>
                    </button>

                    <button className="topBar-nav-item" onClick={handleSettingsClick}>
                        <SettingsIcon />
                        <span className="topBar-nav-text">Settings</span>
                    </button>

                    <button className="topBar-nav-item" onClick={() => setActiveTab('wishlist')}>
                        <WishlistIcon />
                        <span className={`topBar-nav-text`}>Saved Products</span>
                    </button>

                    <button className="topBar-nav-item" onClick={() => setActiveTab('getQuote')}>
                        <GetAQuotationIcon />
                        <span className={`topBar-nav-text`}>Get a quote</span>
                    </button>

                    <div className='topBar-nav-item-border' ></div>

                    <button className="topBar-nav-item topBar-nav-item-logout" onClick={handleLogout}>
                        <LogoutIcon />
                        <span className="topBar-nav-text">Log out</span>
                    </button>

                </div>
            </div>

            {/* Mobile Menu */}
            <div className='mobileMenuHead' >
                <button className="mobileMenuToggle" onClick={() => setIsMobileMenuOpen(!isMobileMenuOpen)}>
                    <HamBurger />
                </button>
                <div className={`mobileMenuContainer ${isMobileMenuOpen ? 'open' : ''}`}>
                    <div className="mobileMenuItems">
                        {showSettingsTabs ? (
                            <>
                                <button
                                    className={`nav-item ${activeTab === 'editProfile' ? 'active' : ''}`}
                                    onClick={() => {
                                        setActiveTab('editProfile');
                                        setIsMobileMenuOpen(false)
                                    }}
                                >
                                    <MyAccountIcon />
                                    <span className="nav-text">Edit Profile</span>
                                </button>
                                <button
                                    className={`nav-item ${activeTab === 'changePassword' ? 'active' : ''}`}
                                    onClick={() => {
                                        setActiveTab('changePassword');
                                        setIsMobileMenuOpen(false)
                                    }}
                                >
                                    <CiLock />
                                    <span className="nav-text">Change Password</span>
                                </button>
                                <button
                                    className={`nav-item ${activeTab === 'notifications' ? 'active' : ''}`}
                                    onClick={() => {
                                        setActiveTab('notifications');
                                        setIsMobileMenuOpen(false)
                                    }}
                                >
                                    <GoBell />
                                    <span className="nav-text">Notifications</span>
                                </button>
                                <button
                                    className={`nav-item ${activeTab === 'privacyData' ? 'active' : ''}`}
                                    onClick={() => {
                                        setActiveTab('privacyData');
                                        setIsMobileMenuOpen(false)
                                    }}
                                >
                                    <GrNotes />
                                    <span className="nav-text">Privacy Data</span>
                                </button>
                            </>
                        ) : (

                            <>
                                <button
                                    className={`nav-item ${activeTab === 'overview' ? 'active' : ''}`}
                                    onClick={() => {
                                        setActiveTab('overview');
                                        setIsMobileMenuOpen(false)
                                    }}
                                >
                                    <OverviewIcon />
                                    <span className="nav-text">Overview</span>
                                </button>
                                <button
                                    className={`nav-item ${activeTab === 'myAccount' ? 'active' : ''}`}
                                    onClick={() => {
                                        setActiveTab('myAccount');
                                        setIsMobileMenuOpen(false)
                                    }}
                                >
                                    <MyAccountIcon />
                                    <span className="nav-text">My Account</span>
                                </button>
                                <button
                                    className={`nav-item ${activeTab === 'wishlist' ? 'active' : ''}`}
                                    onClick={() => {
                                        setActiveTab('wishlist');
                                        setIsMobileMenuOpen(false)
                                    }}
                                >
                                    <WishlistIcon />
                                    <span className="nav-text">Wishlist</span>
                                </button>
                                <button
                                    className={`nav-item ${activeTab === 'getQuote' ? 'active' : ''}`}
                                    onClick={() => {
                                        setActiveTab('getQuote');
                                        setIsMobileMenuOpen(false)
                                    }}
                                >
                                    <i className="fas fa-file-alt nav-icon"></i>
                                    <span className="nav-text">Get a quote</span>
                                </button>
                                <button
                                    className={`nav-item ${activeTab === 'meetingSchedule' ? 'active' : ''}`}
                                    onClick={() => {
                                        setActiveTab('meetingSchedule');
                                        setIsMobileMenuOpen(false)
                                    }}
                                >
                                    <MeetingIcon />
                                    <span className="nav-text">Meeting Schedule</span>
                                </button>
                            </>

                        )}
                        <div className="bottom-nav">
                            {
                                showSettingsTabs ?
                                    <button className="nav-item" onClick={handleSettingsClick}>
                                        <MdArrowBackIosNew />
                                        <span className="nav-text">Back to Main Menu</span>
                                    </button> :
                                    <button className="nav-item" onClick={handleSettingsClick}>
                                        <SettingsIcon />
                                        <span className="nav-text">Settings</span>
                                    </button>
                            }
                            <button className="nav-item" onClick={handleLogout}>
                                <LogoutIcon />
                                <span className="nav-text">Logout</span>
                            </button>
                        </div>
                        <div className='bottom-nav website-menu' >
                            <button className="nav-item" onClick={handleSettingsClick}>
                                <span className="nav-text">Projects</span>
                            </button>
                            <button className="nav-item" onClick={handleSettingsClick}>
                                <span className="nav-text">Products</span>
                            </button>
                            <button className="nav-item" onClick={handleSettingsClick}>
                                <span className="nav-text">Services</span>
                            </button>
                            <button className="nav-item" onClick={handleSettingsClick}>
                                <span className="nav-text">Blog</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div className="dashboard-container">

                {/* Left Menu */}

                <div className={`left-menu ${isMenuCollapsed ? 'collapsed' : ''}`}>
                    <button className="menu-toggle" onClick={() => setIsMenuCollapsed(!isMenuCollapsed)}>
                        <div className='menu-toggle-icon'>
                            {showSettingsTabs ? (
                               <SettingsIcon />
                            ) : (
                                <>
                                <span className='menu-toggle-icon-span'></span>
                                <span className='menu-toggle-icon-span'></span>
                                <span className='menu-toggle-icon-span'></span>
                                </>
                            )}
                        </div>
                        <span className='menu-toggle-text'>{showSettingsTabs ? 'Settings' : 'Menu'}</span>
                    </button>
                    <nav className='left-menu-nav'>
                        {showSettingsTabs ? (
                            <>
                                <button className="nav-item" onClick={() => setActiveTab('editProfile')}>
                                    <div className={`nav-icon ${activeTab === 'editProfile' ? 'active' : ''}`}>
                                        <MyAccountIcon />
                                    </div>
                                    <span className={`nav-text ${activeTab === 'editProfile' ? 'active' : ''}`}>Edit Profile</span>
                                </button>
                                <button className="nav-item" onClick={() => setActiveTab('changePassword')}>
                                    <div className={`nav-icon ${activeTab === 'changePassword' ? 'active' : ''}`}>
                                        <CiLock />
                                    </div>
                                    <span className={`nav-text ${activeTab === 'changePassword' ? 'active' : ''}`}>Change Password</span>
                                </button>
                                <button className="nav-item" onClick={() => setActiveTab('notifications')}>
                                    <div className={`nav-icon ${activeTab === 'notifications' ? 'active' : ''}`}>
                                        <GoBell />
                                    </div>
                                    <span className={`nav-text ${activeTab === 'notifications' ? 'active' : ''}`}>Notifications</span>
                                </button>
                                <button className="nav-item" onClick={() => setActiveTab('privacyData')}>
                                    <div className={`nav-icon ${activeTab === 'privacyData' ? 'active' : ''}`}>
                                        <GrNotes />
                                    </div>
                                    <span className={`nav-text ${activeTab === 'privacyData' ? 'active' : ''}`}>Privacy Data</span>
                                </button>
                            </>
                        ) : (
                            <>
                                <button className="nav-item" onClick={() => setActiveTab('overview')}>
                                    <div className={`nav-icon nav-icon-overview ${activeTab === 'overview' ? 'active' : ''}`}>
                                        <OverviewIcon />
                                    </div>
                                    <span className={`nav-text ${activeTab === 'overview' ? 'active' : ''}`}>Overview</span>
                                </button>
                                <button className="nav-item" onClick={() => setActiveTab('myAccount')}>
                                    <div className={`nav-icon ${activeTab === 'myAccount' ? 'active' : ''}`}>
                                        <MyAccountIcon />
                                    </div>
                                    <span className={`nav-text ${activeTab === 'myAccount' ? 'active' : ''}`}>My Account</span>
                                </button>
                                <button className="nav-item" onClick={() => setActiveTab('wishlist')}>
                                    <div className={`nav-icon ${activeTab === 'wishlist' ? 'active' : ''}`}>
                                        <WishlistIcon />
                                    </div>
                                    <span className={`nav-text ${activeTab === 'wishlist' ? 'active' : ''}`}>Wishlist</span>
                                </button>
                                <button className="nav-item" onClick={() => setActiveTab('getQuote')}>
                                    <div className={`nav-icon ${activeTab === 'getQuote' ? 'active' : ''}`}>
                                        <GetAQuotationIcon />
                                    </div>
                                    <span className={`nav-text ${activeTab === 'getQuote' ? 'active' : ''}`}>Get a quote</span>
                                </button>
                                <button className="nav-item" onClick={() => setActiveTab('meetingSchedule')}>
                                    <div className={`nav-icon nav-icon-meetingSchedule ${activeTab === 'meetingSchedule' ? 'active' : ''}`}>
                                        <MeetingIcon />
                                    </div>
                                    <span className={`nav-text ${activeTab === 'meetingSchedule' ? 'active' : ''}`}>Meeting Schedule</span>
                                </button>
                            </>
                        )}
                    </nav>

                    <div className="bottom-nav">
                        {showSettingsTabs ? (
                            <button className="nav-item" onClick={handleSettingsClick}>
                                <div className='nav-icon nav-icon-back'>
                                    <MdArrowBackIosNew />
                                </div>
                                <span className="nav-text">Back to Main Menu</span>
                            </button>
                        ) : (
                            <button className="nav-item" onClick={handleSettingsClick}>
                                <div className='nav-icon'>
                                    <SettingsIcon />
                                </div>
                                <span className="nav-text">Settings</span>
                            </button>
                        )}
                        <button className="nav-item" onClick={handleLogout}>
                            <div className='nav-icon'>
                                <LogoutIcon />
                            </div>
                            <span className="nav-text">Logout</span>
                        </button>
                    </div>
                </div>

                {/* Main Content */}
                <div className="main-content">
                    {renderContent()}
                </div>
            </div>
        </div >
    );
};

export default MyMiro; 