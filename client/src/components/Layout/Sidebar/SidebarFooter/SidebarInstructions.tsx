import React from 'react';
import { Button, Tooltip } from 'antd';
import { Icon } from '@iconify/react';
import s from '../Sidebar.module.less';

interface SidebarInstructionsProps {
  show: boolean;
  onOpen: () => void;
}

export const SidebarInstructions: React.FC<SidebarInstructionsProps> = ({
  show,
  onOpen,
}) => {
  const [hover, setHover] = React.useState(false);

  const content = (
    <Button
      className={s.instructionsButton}
      onClick={onOpen}
      onMouseEnter={() => setHover(true)}
      onMouseLeave={() => setHover(false)}
      style={{
        backgroundColor: 'var(--color-red-primary)',
        borderColor: 'var(--color-red-primary)',
        color: !hover ? 'var(--color-dark-primary)' : 'var(--color-white-primary)',
      }}
      type="primary"
      block
    >
      <div className={s.instructionsButtonInside}>
        <Icon
          className={`${s.instructionsButtonIcon} ${
            !show ? s.collapsedInstructionsIcon : ''
          }`}
          icon="material-symbols:help-outline"
          width={show ? 20 : 24}
          height={show ? 20 : 24}
        />
        {show && <p>Instrukcja</p>}
      </div>
    </Button>
  );

  if (!show) {
    return (
      <Tooltip title="Instrukcja" placement="right">
        {content}
      </Tooltip>
    );
  }

  return content;
};
