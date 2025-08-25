import React, { useState } from 'react';

const PrivacyAndData = () => {
    const [formData, setFormData] = useState({
        dataCollection: false,
        dataStorage: false,
        dataSharing: false,
        accountAccess: {
            allowAccess: false,
            allowCorrection: false,
            allowDeletion: false,
        },
        emailPreferences: {
            receiveMarketing: false,
            receiveTransactional: false,
        },
    });

    const handleChange = (e) => {
        const { name, value, type, checked } = e.target;
        if (type === 'checkbox') {
            setFormData({
                ...formData,
                [name]: checked,
            });
        } else {
            setFormData({
                ...formData,
                [name]: value,
            });
        }
    };

    const handleUpdate = () => {
        // Logic to save changes, e.g., API call
        console.log('Settings Updated', formData);
    };

    return (
        <div className="privacy-container">
            <h2 className="privacy-heading">Privacy and Data</h2>
            <p className="privacy-description">
                Your Data, Your Choice: Empowering You with Full Control Over Privacy and Personalization
            </p>

            <div className="privacy-border"></div>

            {/* Data Collection & Use Section */}
            <div className="privacy-sec">
                <h3 className="privacy-subheading">Data Collection & Use</h3>
                <p className="privacy-text">
                    We collect information to personalize and enhance your experience with Miro Lighting Solutions
                </p>
                <div className="privacy-checkbox">
                    <input
                        type="checkbox"
                        name="dataCollection"
                        checked={formData.dataCollection}
                        onChange={handleChange}
                    />
                    <label>Opt-in to provide data for enhancing your experience</label>
                </div>

                <div className="privacy-border"></div>
            </div>

            {/* Data Storage & Security Section */}
            <div className="privacy-sec">
                <h3 className="privacy-subheading">Data Storage & Security</h3>
                <p className="privacy-text">
                    Your personal data is stored securely and protected with encryption.
                </p>
                <div className="privacy-checkbox">
                    <input
                        type="checkbox"
                        name="dataStorage"
                        checked={formData.dataStorage}
                        onChange={handleChange}
                    />
                    <label>Allow Data Storage</label>
                </div>

                <div className="privacy-border"></div>
            </div>

            {/* Data Sharing & Third Parties Section */}
            <div className="privacy-sec">
                <h3 className="privacy-subheading">Data Sharing & Third Parties</h3>
                <p className="privacy-text">
                    We do not share your personal information with third parties without your consent, except as required by law.
                </p>
                <div className="privacy-checkbox">
                    <input
                        type="checkbox"
                        name="dataSharing"
                        checked={formData.dataSharing}
                        onChange={handleChange}
                    />
                    <label>Allow Sharing with Third Parties</label>
                </div>

                <div className="privacy-border"></div>
            </div>

            {/* Account Information Access Section */}
            <div className="privacy-sec">
                <h3 className="privacy-subheading">Account Information Access</h3>
                <p className="privacy-text">
                    As an account holder, you have the right to view, edit, or delete your personal information.
                </p>
                <div className="privacy-checkbox">
                    <input
                        type="checkbox"
                        name="allowAccess"
                        checked={formData.accountAccess.allowAccess}
                        onChange={handleChange}
                    />
                    <label>Allow Access to My Data</label>
                </div>
                <div className="privacy-checkbox">
                    <input
                        type="checkbox"
                        name="allowCorrection"
                        checked={formData.accountAccess.allowCorrection}
                        onChange={handleChange}
                    />
                    <label>Allow Data Correction</label>
                </div>
                <div className="privacy-checkbox">
                    <input
                        type="checkbox"
                        name="allowDeletion"
                        checked={formData.accountAccess.allowDeletion}
                        onChange={handleChange}
                    />
                    <label>Allow Account Deletion</label>
                </div>

                <div className="privacy-border"></div>
            </div>

            {/* Email & Communication Preferences Section */}
            <div className="privacy-sec">
                <h3 className="privacy-subheading">Email & Communication Preferences</h3>
                <p className="privacy-text">
                    You can manage how you receive email notifications from us.
                </p>
                <div className="privacy-checkbox">
                    <input
                        type="checkbox"
                        name="receiveMarketing"
                        checked={formData.emailPreferences.receiveMarketing}
                        onChange={handleChange}
                    />
                    <label>Receive Marketing Emails</label>
                </div>
                <div className="privacy-checkbox">
                    <input
                        type="checkbox"
                        name="receiveTransactional"
                        checked={formData.emailPreferences.receiveTransactional}
                        onChange={handleChange}
                    />
                    <label>Receive Transactional Emails</label>
                </div>

                <div className="privacy-border"></div>
            </div>

            {/* Delete Your Data and Account */}
            <div className='privacy-delete-data' >
                <h1> Delete your data and account </h1>
                <button className="privacy-delete-btn">
                    Update
                </button>

                <div className="privacy-border"></div>
            </div>

            {/* Request Your Data and Account */}
            <div className='privacy-request-data' >
                <h1> Request your data </h1>
                <p> You can request a copy of the info Miro collects about you.</p>
                <p> You'll receive an email from our third-party provider SendSafely to complete your request.</p>
                <button className="privacy-request-btn" >
                    Request Your Data
                </button>
            </div>
        </div>
    );
};

export default PrivacyAndData;
