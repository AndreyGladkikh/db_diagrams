import React from 'react';

class SignUp extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            email: null,
            password: null
        };

        this.handleCliskSignupBtn = this.handleCliskSignupBtn.bind(this);
        this.handleChangeEmailInput = this.handleChangeEmailInput.bind(this);
        this.handleChangePasswordInput = this.handleChangePasswordInput.bind(this);
    }

    handleCliskSignupBtn() {
        var body = [];
        for (var property in this.state) {
            var encodedKey = encodeURIComponent(property);
            var encodedValue = encodeURIComponent(this.state[property]);
            body.push(encodedKey + "=" + encodedValue);
        }
        body = body.join("&");

        fetch('/api/signup', {
            method: 'POST',
            body: body,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8',
                'Authorization': 'Bearer ' + localStorage.getItem('authToken')
            }
        })
            .then(response => response.json())
            .then(response => console.log(response))
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
                <div className={"form signup-form"}>
                    <div className={"input-wrap"}>
                        <input type="email" onChange={this.handleChangeEmailInput} />
                    </div>
                    <div className={"input-wrap"}>
                        <input type="password" onChange={this.handleChangePasswordInput} />
                    </div>
                    <button onClick={this.handleCliskSignupBtn}>Зарегистрироваться</button>
                </div>
            </div>
        );
    }
}

export default SignUp