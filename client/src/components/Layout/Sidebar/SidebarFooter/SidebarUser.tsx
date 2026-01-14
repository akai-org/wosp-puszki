import React from 'react';
import s from '../Sidebar.module.less';
import { Icon } from '@iconify/react';
import { Tooltip } from 'antd';

interface SidebarUserProps {
  show: boolean;
  userName: string;
}

export const SidebarUser: React.FC<SidebarUserProps> = ({ show, userName }) => {
  if (show) {
    return (
      <div data-testid="userNameDescription" className={s.userNameDescription}>
        <p className={s.userNameTitle}>Użytkownik:</p>
        <p className={s.userName}>{userName}</p>
      </div>
    );
  } else {
    return (
      <Tooltip data-testid="userNameDescription" title={userName} placement="right">
        <Icon
          icon="material-symbols:person-outline-rounded"
          color="white"
          width="24"
          height="24"
        />
      </Tooltip>
    );
  }
};
