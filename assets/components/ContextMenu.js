import React from 'react';
import './ContextMenu.scss';

class ContextMenu extends React.Component {
    constructor(props) {
        super(props);

        this.handleClickAddTable = this.handleClickAddTable.bind(this);
    }

    handleClickAddTable(e) {
        fetch('', {
            method: "POST"
        })
            .then()
            .then();
    }

    render() {
        const {showMenu, xPos, yPos} = this.props;
        if (showMenu) {
            return (
                <div className={"context-menu-wrap"}
                     style={{
                         left: xPos,
                         top: yPos,
                     }}>
                    <div className={"context-menu project-workspace__context-menu"}>
                        <div className="context-menu__tab add-table-tab" onClick={this.handleClickAddTable}>Add table</div>
                    </div>
                </div>
            );
        } else {
            return null;
        }
    }
}

export default ContextMenu