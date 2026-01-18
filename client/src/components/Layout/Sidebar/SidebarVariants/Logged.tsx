import { Layout, Tooltip } from 'antd';
import React, { useEffect, useState } from 'react';
import s from '../Sidebar.module.less';
import Logo from '@/assets/wosp.svg';
import { SidebarItem } from '@components/Layout/Sidebar/SidebarItem/SidebarItem';
import { SubNavLink } from '@/utils';
import { InstructionsModal } from '@components/Modal/InstructionsModal/InstructionsModal';
import { SidebarActions } from '../SidebarFooter/SidebarActions';
import { SidebarUser } from '../SidebarFooter/SidebarUser';
import { SidebarInstructions } from '../SidebarFooter/SidebarInstructions';

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

  useEffect(() => {
    try {
      const hideIntructions = localStorage.getItem('HIDE_INSTRUCTIONS_ON_LOGIN');
      if (!hideIntructions) {
        setIsInstructionsOpen(true);
      }
    } catch (e) {
      console.error(e);
    }
  }, []);

  const handleLogout = () => {
    deleteCredentials();
  };

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
          <SidebarInstructions show={show} onOpen={() => setIsInstructionsOpen(true)} />
          <SidebarUser show={show} userName={userName} />
          <SidebarActions onToggle={toggleSidebar} onLogout={handleLogout} show={show} />
        </Footer>
      </Layout>
      <InstructionsModal
        isOpen={isInstructionsOpen}
        onClose={() => setIsInstructionsOpen(false)}
      />
    </>
  );
};
