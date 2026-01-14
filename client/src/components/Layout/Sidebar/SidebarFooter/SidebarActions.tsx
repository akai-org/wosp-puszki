import React from 'react';
import { Button } from 'antd';
import { Icon } from '@iconify/react';
import s from '../Sidebar.module.less';

interface SidebarActionsProps {
  onToggle: () => void;
  onLogout: () => void;
  show: boolean;
}

export const SidebarActions: React.FC<SidebarActionsProps> = ({
  onToggle,
  onLogout,
  show,
}) => {
  return (
    <>
      <Button
        data-testid="logOutButton"
        className={s.logOutButton}
        onClick={onLogout}
        type="primary"
        block
      >
        <div className={s.logOutButtonInside}>
          <Icon
            className={s.logOutButtonInside_icon}
            icon="ic:round-log-out"
            color="#002329"
            width="20"
            height="20"
          />
          {show ? <p>Wyloguj</p> : null}
        </div>
      </Button>
      <Button
        data-testid="toggleSidebarButton"
        className={s.toggleSidebarButton}
        onClick={onToggle}
        type="text"
      >
        <div className={s.logOutButtonInside}>
          {show ? (
            <Icon icon="majesticons:eye-line" color="white" width="20" height="20" />
          ) : (
            <Icon icon="majesticons:eye-off-line" color="white" width="20" height="20" />
          )}
        </div>
      </Button>
    </>
  );
};
