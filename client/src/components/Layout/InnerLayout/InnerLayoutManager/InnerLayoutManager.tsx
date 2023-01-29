import { FC } from 'react';
import { InnerLayout } from '@/components';
import { SubNavLink, useAuthContext } from '@/utils';
import { useLocation } from 'react-router-dom';

interface Props {
  excludingLinks: string[];
  links: SubNavLink[];
  prefix?: string;
}

export const InnerLayoutManager: FC<Props> = ({ excludingLinks, links, prefix = '' }) => {
  const location = useLocation();
  const { username } = useAuthContext();

  const prefixedExcludingLinks = excludingLinks.map((link) => `${prefix}/${link}`);

  const hideNavbar = prefixedExcludingLinks.includes(location.pathname);
  let modifiedLinks = links;

  if (username && username?.slice(0, 4) == 'wosp') {
    modifiedLinks = modifiedLinks.filter((link) => link.label !== 'Wydaj puszkę');
  }

  return <InnerLayout links={modifiedLinks} hideNavbar={hideNavbar} />;
};
