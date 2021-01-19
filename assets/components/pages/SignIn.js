import React from 'react';

class SignIn extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            email: null,
            password: null
        };

        this.handleCliskSigninBtn = this.handleCliskSigninBtn.bind(this);
        this.handleChangeEmailInput = this.handleChangeEmailInput.bind(this);
        this.handleChangePasswordInput = this.handleChangePasswordInput.bind(this);
    }

    handleCliskSigninBtn() {
        fetch('/api/login_check', {
            method: 'POST',
            body: JSON.stringify({
                username: this.state.email,
                password: this.state.password
            }),
            headers: {
                'Content-Type': 'application/json;charset=utf-8',
            }
        })
            .then(response => response.json())
            .then(response => {
                if(response.hasOwnProperty('token')) {
                    localStorage.setItem('authToken', response.token);
                }
            })
    }

    handleChangeEmailInput(e) {
        this.setState(state => ({
            email: e.target.value
        }));
    }

    handleChangePasswordInput(e) {
        this.setState(state => ({
            password: e.target.value
        }));
    }

    render() {
        return (
            <div className={"form-wrap"}>
                <div>{this.state.email}</div>
                <div>{this.state.password}</div>
                <div className={"form signin-form"}>
                    <div className={"input-wrap"}>
                        <input type="email" onChange={this.handleChangeEmailInput} />
                    </div>
                    <div className={"input-wrap"}>
                        <input type="password" onChange={this.handleChangePasswordInput} />
                    </div>
                    <button className={"btn btn-signin"} onClick={this.handleCliskSigninBtn}>Войти</button>
                </div>
            </div>
        );
    }
}

export default SignIn