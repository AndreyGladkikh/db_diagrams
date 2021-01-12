import React from 'react';

class Header extends React.Component {
    render() {
        return (
            <div className="main-header">
                <div className="logo-wrap"><div className="logo"></div></div>
                <div className="search-bar-wrap"><div className="search-bar"></div></div>
                <div className="auth-block-wrap">
                    <div className="auth-block">
                        <span className="login"></span>
                        <span className="logout"></span>
                    </div>
                </div>
            </div>
        );
    }
}

export default Header;