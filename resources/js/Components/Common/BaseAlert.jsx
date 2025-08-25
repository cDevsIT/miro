import React from 'react';

const BaseAlert = ({ 
    isOpen, 
    onClose, 
    onConfirm, 
    title = 'Confirm Action',
    message, 
    confirmText = 'Confirm',
    cancelText = 'Cancel',
    type = 'info' // can be 'info', 'delete', 'warning', 'success'
}) => {
    if (!isOpen) return null;

    const getTypeStyles = () => {
        switch (type) {
            case 'delete':
                return {
                    confirmButton: 'bg-red-500 hover:bg-red-600',
                    icon: 'text-red-500',
                    iconClass: 'fa-trash-alt'
                };
            case 'warning':
                return {
                    confirmButton: 'bg-yellow-500 hover:bg-yellow-600',
                    icon: 'text-yellow-500',
                    iconClass: 'fa-exclamation-triangle'
                };
            case 'success':
                return {
                    confirmButton: 'bg-green-500 hover:bg-green-600',
                    icon: 'text-green-500',
                    iconClass: 'fa-check-circle'
                };
            default:
                return {
                    confirmButton: 'bg-blue-500 hover:bg-blue-600',
                    icon: 'text-blue-500',
                    iconClass: 'fa-info-circle'
                };
        }
    };

    const typeStyles = getTypeStyles();

    return (
        <div className="modal-overlay">
            <div className="modal-content">
                <div className="modal-header">
                    <h3>{title}</h3>
                    <button className="close-btn" onClick={onClose}>×</button>
                </div>
                <div className="modal-body">
                    <p>{message}</p>
                </div>
                <div className="modal-footer">
                    <button className="cancel-btn" onClick={onClose}>{cancelText}</button>
                    <button 
                        className={`confirm-btn ${type === 'delete' ? 'delete-btn' : ''}`} 
                        onClick={onConfirm}
                    >
                        {confirmText}
                    </button>
                </div>
            </div>
        </div>
    );
};

export default BaseAlert; 