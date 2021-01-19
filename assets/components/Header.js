import React from 'react';
import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link,
    NavLink
} from "react-router-dom";

class Header extends React.Component {
    constructor(props) {
        super(props);

        this.handleClickLogout = this.handleClickLogout.bind(this);
    }

    handleClickLogout() {
        localStorage.removeItem('authToken');
    }

    render() {
        return (
            <div className={"main-header"}>
                <div className={"logo-wrap"}>
                    <div className={"logo"}>
                        <Link to={"/"}>На главную</Link>
                    </div>
                </div>
                <div className={"search-bar-wrap"}><div className={"search-bar"}></div></div>
                <div className={"auth-block-wrap"}>
                    <div className={"auth-block"}>
                        <span className={"register"}>
                            <Link to={"/signup"}>Зарегистрироваться</Link>
                        </span>
                        <span className={"login"}>
                            <Link to={"/signin"}>Войти</Link>
                        </span>
                        <span className={"logout"} onClick={this.handleClickLogout}>Выйти</span>
                    </div>
                </div>
                <div className={"menu-wrap"}>
                    <ul className={"menu"}>
                        <NavLink to="/projects/my">Мои проекты</NavLink>
                        <NavLink to="/project">Проект</NavLink>
                    </ul>
                </div>
            </div>
        );
    }
}

export default Header;