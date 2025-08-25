import React, { useState } from 'react';

const ChangePassword = () => {
    const [formData, setFormData] = useState({
        password: '',
        resetPassword: '',
    });

    const handleInputChange = (e) => {
        const { name, value } = e.target;
        setFormData({
            ...formData,
            [name]: value,
        });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        // Add form submission logic here
    };

    return (
        <div className="edit-pass-container">
            <h2 className="edit-pass-heading">Change Password</h2>
            <p className="edit-pass-description">
                Update your password to keep your account protected.
            </p>

            <form onSubmit={handleSubmit} className='edit-pass-box' >
                <div className="edit-pass-form-group">
                    <label htmlFor="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        value={formData.password}
                        onChange={handleInputChange}
                    />
                </div>

                <div className="edit-pass-form-group">
                    <label htmlFor="resetPassword">Reset Password</label>
                    <input
                        type="password"
                        id="resetPassword"
                        name="resetPassword"
                        value={formData.resetPassword}
                        onChange={handleInputChange}
                    />
                </div>

                <div className='edit-pass-btn-div' >
                    <button type="submit" className="edit-pass-submit-btn">
                        Update
                    </button>
                </div>
            </form>
        </div>
    );
};

export default ChangePassword;
