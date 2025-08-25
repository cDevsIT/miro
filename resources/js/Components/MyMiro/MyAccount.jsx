import React from 'react';

const MyAccount = ({ customer, setActiveTab, setShowSettingsTabs }) => {
    return (
        <div className="my-account-container">
            <h1>My Account</h1>

            <div className="profile-section">
                <div className="profile-image">
                    {/* Placeholder circle for profile image */}
                    <div className="image-placeholder"></div>
                </div>
                <div className="profile-info">
                    <h2>{customer?.name}</h2>
                    <p className="profession">architect</p>
                    <p className="email">{customer?.email}</p>
                    <p className="phone">{customer?.phone}</p>
                </div>
            </div>

            <hr className="divider" />

            <div className="personal-information">
                <h2>Personal Information</h2>

                <div className="info-grid">
                    <div className="info-group">
                        <label>First Name</label>
                        <p>{customer?.name.split(' ')[0]}</p>
                    </div>

                    <div className="info-group">
                        <label>Last Name</label>
                        <p>{customer?.name.split(' ')[1]} {''} {customer?.name.split(' ')[2]} {''} {customer?.name.split(' ')[3]}</p>
                    </div>

                    <div className="info-group">
                        <label>Email</label>
                        <p>{customer?.email}</p>
                    </div>

                    <div className="info-group">
                        <label>Phone Number</label>
                        <p>{customer?.phone}</p>
                    </div>

                    <div className="info-group">
                        <label>Profession</label>
                        <p>Architect</p>
                    </div>

                    <div className="info-group">
                        <label>Address</label>
                        <p>Add +</p>
                    </div>
                </div>

                <div className='edit-button-div' >
                    <button className="action-links-button"
                        onClick={() => {
                            setActiveTab('editProfile');
                            setShowSettingsTabs(true);
                        }} >
                        Edit
                        <span className='action-link-underline'></span>
                    </button>
                </div>
            </div>


        </div>
    );
};

export default MyAccount; 