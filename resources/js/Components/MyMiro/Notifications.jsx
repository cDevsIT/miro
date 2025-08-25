import React, { useState } from 'react';

const NotificationSettings = () => {
    const [formData, setFormData] = useState({
        emailNotifications: false,
        inboxAlerts: {
            newQuotations: false,
            documentUploads: false,
            accountActivity: false,
        },
        emailPreferences: {
            instantAlerts: false,
            dailySummary: false,
            weeklyDigest: false,
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
        // Logic to save the changes, e.g., API call
        console.log('Settings Updated', formData);
    };

    return (
        <div className="edit-notif-container">
            <h2 className="edit-notif-heading">Notification</h2>
            <p className="edit-notif-description">
                Manage how and when you receive email notifications from us.
            </p>
            <div className="notif-border"></div>

            <div className="edit-notif-section">
                <h3 className="edit-notif-subheading">Email Notifications</h3>
                <p className="edit-notif-text">
                    Stay updated with the latest information delivered directly to your inbox.
                </p>
                <div className="edit-notif-checkbox">
                    <input
                        type="checkbox"
                        name="emailNotifications"
                        checked={formData.emailNotifications}
                        onChange={handleChange}
                    />
                    <label>Manage how and when you receive email notifications from us.</label>
                </div>
                <div className="notif-border"></div>
            </div>

            <div className="edit-notif-section">
                <h3 className="edit-notif-subheading">Inbox Alerts</h3>
                <p className="edit-notif-text">
                    Receive important notifications via email to stay informed about your requests and updates.
                </p>
                <div className="edit-notif-checkbox">
                    <input
                        type="checkbox"
                        name="newQuotations"
                        checked={formData.inboxAlerts.newQuotations}
                        onChange={(e) =>
                            setFormData({
                                ...formData,
                                inboxAlerts: {
                                    ...formData.inboxAlerts,
                                    newQuotations: e.target.checked,
                                },
                            })
                        }
                    />
                    <label>New Quotation Requests</label>
                </div>
                <div className="edit-notif-checkbox">
                    <input
                        type="checkbox"
                        name="documentUploads"
                        checked={formData.inboxAlerts.documentUploads}
                        onChange={(e) =>
                            setFormData({
                                ...formData,
                                inboxAlerts: {
                                    ...formData.inboxAlerts,
                                    documentUploads: e.target.checked,
                                },
                            })
                        }
                    />
                    <label>Document Uploads</label>
                </div>
                <div className="edit-notif-checkbox">
                    <input
                        type="checkbox"
                        name="accountActivity"
                        checked={formData.inboxAlerts.accountActivity}
                        onChange={(e) =>
                            setFormData({
                                ...formData,
                                inboxAlerts: {
                                    ...formData.inboxAlerts,
                                    accountActivity: e.target.checked,
                                },
                            })
                        }
                    />
                    <label>Account Activity (e.g., password change)</label>
                </div>
                <div className="notif-border"></div>
            </div>

            <div className="edit-notif-btn-group">

                <div className="edit-notif-section">
                    <h3 className="edit-notif-subheading">Email Preferences</h3>
                    <p className="edit-notif-text">
                        Manage how and when you receive email notifications from us.
                    </p>
                    <div className="edit-notif-checkbox">
                        <input
                            type="checkbox"
                            name="instantAlerts"
                            checked={formData.emailPreferences.instantAlerts}
                            onChange={(e) =>
                                setFormData({
                                    ...formData,
                                    emailPreferences: {
                                        ...formData.emailPreferences,
                                        instantAlerts: e.target.checked,
                                    },
                                })
                            }
                        />
                        <label>Instant Email Alerts</label>
                    </div>
                    <div className="edit-notif-checkbox">
                        <input
                            type="checkbox"
                            name="dailySummary"
                            checked={formData.emailPreferences.dailySummary}
                            onChange={(e) =>
                                setFormData({
                                    ...formData,
                                    emailPreferences: {
                                        ...formData.emailPreferences,
                                        dailySummary: e.target.checked,
                                    },
                                })
                            }
                        />
                        <label>Daily Summary</label>
                    </div>
                    <div className="edit-notif-checkbox">
                        <input
                            type="checkbox"
                            name="weeklyDigest"
                            checked={formData.emailPreferences.weeklyDigest}
                            onChange={(e) =>
                                setFormData({
                                    ...formData,
                                    emailPreferences: {
                                        ...formData.emailPreferences,
                                        weeklyDigest: e.target.checked,
                                    },
                                })
                            }
                        />
                        <label>Weekly Digest</label>
                    </div>
                </div>

                <button className="edit-notif-submit-btn" onClick={handleUpdate}>
                    Update
                </button>

            </div>
        </div>
    );
};

export default NotificationSettings;
