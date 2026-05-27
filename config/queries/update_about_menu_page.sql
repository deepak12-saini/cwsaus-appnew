-- About Us page: banner subtitle + fallback content (body copy is in templates/Fronts/about.php)
UPDATE menu_pages SET
  banner_sub_text = 'Professional waterproofing contracting & installation across Australia',
  main_title = 'About Us',
  content = 'CWS Australia is a professional waterproofing contracting and installation company. With over 100 years of combined experience across our national team, we are a preferred choice for domestic and national builders, constructors, and commercial clients.',
  updated_at = NOW()
WHERE id = 1;
