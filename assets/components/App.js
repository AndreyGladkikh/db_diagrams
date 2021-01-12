import React from 'react';
import Header from "./header/Header";

class App extends React.Component {
    state = {
        service: {
            types: [
                {id: '1', name: 'Дизайн'},
                {id: '2', name: 'Разработка и IT'},
            ]
        }
    };

    render() {
        return (
            <Header serviceTypes={this.state.service.types}/>
        );
    }
}

export default App;