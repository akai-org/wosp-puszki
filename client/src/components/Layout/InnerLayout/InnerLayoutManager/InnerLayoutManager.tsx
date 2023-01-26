import { FC } from 'react';
import { InnerLayout } from '@/components';
import { SubNavLink } from '@/utils';
import { useLocation } from 'react-router-dom';

interface Props {
  excludingLinks: string[];
  links: SubNavLink[];
  prefix?: string;
}

export const InnerLayoutManager: FC<Props> = ({ excludingLinks, links, prefix = '' }) => {
  const location = useLocation();

  const prefixedExcludingLinks = excludingLinks.map((link) => `${prefix}/${link}`);

  const hideNavbar = prefixedExcludingLinks.includes(location.pathname);

  return <InnerLayout links={links} hideNavbar={hideNavbar} />;
};
