import React from 'react';

class SignUp extends React.Component {
    render() {
        return (
            <div className={"form-wrap"}>
                <div className={"form signup-form"}>
                    <div className={"input-wrap"}>
                        <input type="email" />
                    </div>
                    <div className={"input-wrap"}>
                        <input type="password" />
                    </div>
                    <button>Зарегистрироваться</button>
                </div>
            </div>
        );
    }
}

export default SignUp