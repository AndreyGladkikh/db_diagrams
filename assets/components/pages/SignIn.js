import React from 'react';

class SignIn extends React.Component {
    render() {
        return (
            <div className={"form-wrap"}>
                <div className={"form signin-form"}>
                    <div className={"input-wrap"}>
                        <input type="email" />
                    </div>
                    <div className={"input-wrap"}>
                        <input type="password" />
                    </div>
                    <button>Войти</button>
                </div>
            </div>
        );
    }
}

export default SignIn