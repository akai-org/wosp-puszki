import { Button, Layout } from 'antd';
import React, { useState, useEffect } from 'react';
import s from '../Sidebar.module.less';
import Logo from '@/assets/wosp.svg';
import { SidebarItem } from '@components/Layout/Sidebar/SidebarItem/SidebarItem';
import { SubNavLink } from '@/utils';
import { Icon } from '@iconify/react';
import { Tooltip } from 'antd';
import { InstructionsModal } from '@components/Modal/InstructionsModal/InstructionsModal';

const { Header, Footer } = Layout;

type SidebarData = {
  show: boolean;
  userName: string;
  links: SubNavLink[];
  toggleSidebar: () => void;
  deleteCredentials: () => void;
};

export const Logged: React.FC<SidebarData> = ({
  show,
  userName,
  links,
  toggleSidebar,
  deleteCredentials,
}) => {
  const [isInstructionsOpen, setIsInstructionsOpen] = useState(false);
  const [hover, setHover] = useState(false);

  useEffect(() => {
    try {
      const showInstructions = localStorage.getItem('SHOW_INSTRUCTIONS_ON_LOGIN');
      const hideIntructions = localStorage.getItem('HIDE_INSTRUCTIONS_ON_LOGIN');
      if (showInstructions && !hideIntructions) {
        setIsInstructionsOpen(true);
        localStorage.removeItem('SHOW_INSTRUCTIONS_ON_LOGIN');
      }
    } catch (e) {}
  }, []);

  const handleLogout = () => {
    deleteCredentials();
  };

  // Ogarnąć by to wyglądało tak jak w Figmie, ikony itp.
  return (
    <>
      <Layout className={[s.sidebarLayout, !show ? s.narrow : null].join(' ')}>
        <Header className={s.sidebarHeader}>
          <img src={Logo} alt="WOSP Logo" />
        </Header>
        <Layout className={[s.sidebarContent, !show ? s.narrow : null].join(' ')}>
          {links.map(({ label, url }) =>
            show ? (
              <SidebarItem label={label} url={url} key={label} show={show} />
            ) : (
              <Tooltip key={label} title={label} placement="right">
                <span>
                  <SidebarItem label={label} url={url} show={show} />
                </span>
              </Tooltip>
            ),
          )}
        </Layout>
        <Footer className={s.sidebarFooter}>
          {show ? (
            <Button
              className={s.instructionsButton}
              onClick={() => setIsInstructionsOpen(true)}
              onMouseEnter={() => setHover(true)}
              onMouseLeave={() => setHover(false)}
              style={{
                backgroundColor: 'var(--color-red-primary)',
                borderColor: 'var(--color-red-primary)',
                color: !hover
                  ? 'var(--color-dark-primary)'
                  : 'var(--color-white-primary)',
              }}
              type="primary"
              block
            >
              <div className={s.instructionsButtonInside}>
                <Icon
                  className={s.instructionsButtonIcon}
                  icon="material-symbols:help-outline"
                  width={show ? 20 : 24}
                  height={show ? 20 : 24}
                />
                <p>Instrukcja</p>
              </div>
            </Button>
          ) : (
            <Button
              className={s.instructionsButton}
              onClick={() => setIsInstructionsOpen(true)}
              onMouseEnter={() => setHover(true)}
              onMouseLeave={() => setHover(false)}
              style={{
                backgroundColor: 'var(--color-red-primary)',
                borderColor: 'var(--color-red-primary)',
                color: !hover
                  ? 'var(--color-dark-primary)'
                  : 'var(--color-white-primary)',
              }}
              type="primary"
              block
            >
              <Tooltip title="Instrukcja" placement="right">
                <Icon
                  className={`${s.instructionsButtonIcon} ${
                    !show ? s.collapsedInstructionsIcon : ''
                  }`}
                  icon="material-symbols:help-outline"
                  width={!show ? 24 : 20}
                  height={!show ? 24 : 20}
                />
              </Tooltip>
            </Button>
          )}
          {show ? (
            <div data-testid="userNameDescription" className={s.userNameDescription}>
              <p className={s.userNameTitle}>Użytkownik:</p>
              <p className={s.userName}>{userName}</p>
            </div>
          ) : (
            <Tooltip data-testid="userNameDescription" title={userName} placement="right">
              <Icon
                icon="material-symbols:person-outline-rounded"
                color="white"
                width="24"
                height="24"
              />
            </Tooltip>
          )}
          <Button
            data-testid="logOutButton"
            className={s.logOutButton}
            onClick={handleLogout}
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
            onClick={toggleSidebar}
            type="text"
          >
            <div className={s.logOutButtonInside}>
              {show ? (
                <Icon icon="majesticons:eye-line" color="white" width="20" height="20" />
              ) : (
                <Icon
                  icon="majesticons:eye-off-line"
                  color="white"
                  width="20"
                  height="20"
                />
              )}
            </div>
          </Button>
        </Footer>
      </Layout>
      <InstructionsModal
        isOpen={isInstructionsOpen}
        onClose={() => setIsInstructionsOpen(false)}
      />
    </>
  );
};
