import React, { useEffect, useState } from 'react';
import axios from 'axios';

const MyAccount = ({ customer: customerProp, setActiveTab, setShowSettingsTabs }) => {
    const [customer, setCustomer] = useState(customerProp || null);

    useEffect(() => {
        if (!customerProp) {
            axios.get('/mymiro/customer-data').then(({ data }) => {
                if (data && data.customer) setCustomer(data.customer);
            }).catch(() => {});
        }
    }, [customerProp]);

    const firstName = (customer?.name || '').split(' ')[0] || '';
    const lastName = (customer?.name || '').split(' ').slice(1).join(' ') || '';
    return (
        <div className="my-account-container">
            <h1>My Account</h1>

            <div className="profile-section">
                <div className="profile-image">
                    <div className="image-placeholder">
                        {customer?.avatar && (
                            <img src={customer.avatar} alt="Avatar" style={{ width: '100%', height: '100%', objectFit: 'cover', borderRadius: '50%' }} />
                        )}
                    </div>
                </div>
                <div className="profile-info">
                    <h2>{customer?.name}</h2>
                    <p className="profession">{customer?.profession || '—'}</p>
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
                        <p>{firstName}</p>
                    </div>

                    <div className="info-group">
                        <label>Last Name</label>
                        <p>{lastName}</p>
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
                        <p>{customer?.profession || '—'}</p>
                    </div>

                    <div className="info-group">
                        <label>Address</label>
                        <p>{customer?.address || '—'}</p>
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