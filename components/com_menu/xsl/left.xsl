<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" />


	<xsl:template match='menu'>
		<xsl:apply-templates select='node' />
	</xsl:template>

	<xsl:template match='node'>


		<xsl:if test="not(@hide) and @left='1'">



			<xsl:variable name="aliasOld">
				<xsl:value-of select="@id" />
			</xsl:variable>

			<xsl:variable name="alias"
				select="translate($aliasOld,'/','')" />

			<a class="nav-link">

				<xsl:if test="descendant::node">
					<xsl:attribute name='class'>nav-link collapsed</xsl:attribute>
					<xsl:attribute name='data-bs-toggle'>collapse</xsl:attribute>
					<xsl:attribute name='data-bs-target'>#collapse<xsl:value-of
						select="$alias" /></xsl:attribute>
					<xsl:attribute name='aria-controls'>collapse<xsl:value-of
						select="$alias" /></xsl:attribute>
				</xsl:if>

				<xsl:if test="descendant-or-self::node[@id=$id]">
					<xsl:attribute name='class'>nav-link active</xsl:attribute>

				</xsl:if>
				
				
				<xsl:if test="@id=$id">
					<xsl:attribute name='class'>nav-link active</xsl:attribute>

				</xsl:if>



				<xsl:choose>
					<xsl:when test="descendant::node">
						<xsl:attribute name='href'>javascript:void(0);</xsl:attribute>
					</xsl:when>
					<xsl:otherwise>
						<xsl:if test="@id!=''">
							<xsl:attribute name='href'>
							<xsl:value-of select="@url" />
						</xsl:attribute>
						</xsl:if>
					</xsl:otherwise>
				</xsl:choose>


			<xsl:if test="@icon!=''">
				<xsl:variable name="link">
					<xsl:value-of select="@icon" />
				</xsl:variable>
			</xsl:if>


			<xsl:variable name="link-style">
				<xsl:choose>
					<xsl:when test="@icon-style!=''">
						<xsl:value-of select="@icon-style" />
					</xsl:when>
					<xsl:otherwise>
						fas
					</xsl:otherwise>
				</xsl:choose>
			</xsl:variable>


			<xsl:variable name="link">
				<xsl:choose>
					<xsl:when test="@icon!=''">
						<xsl:value-of select="@icon" />
					</xsl:when>
				</xsl:choose>
			</xsl:variable>

			<xsl:variable name="link-color">
				<xsl:choose>
					<xsl:when test="@icon-color!=''">
						<xsl:value-of select="@icon-color" />
					</xsl:when>
					<xsl:otherwise>
						white
					</xsl:otherwise>
				</xsl:choose>
			</xsl:variable>
				<div class="nav-link-icon">
					<i class="{$link-style} fa-{$link} fa-lg text-{$link-color}"></i>
				</div>

				<xsl:choose>
					<xsl:when test="@html!=''">
						<xsl:value-of select="@html"
							disable-output-escaping="yes" />
					</xsl:when>
					<xsl:otherwise>
						<xsl:value-of select="label" />
					</xsl:otherwise>
				</xsl:choose>
				<xsl:if test="descendant::node">
					<div class="drawer-collapse-arrow">
						<i class="material-icons">expand_more</i>
					</div>
				</xsl:if>
			</a>



			<xsl:if test="descendant::node">
				<!-- Nested drawer nav -->
				<div class="collapse" id="collapse{$alias}"	aria-labelledby="headingOne" data-bs-parent="#drawerAccordion">

					<xsl:if test="parent::node">
						<xsl:attribute name='data-bs-parent'>#drawerAccordion<xsl:value-of select="../@id"/></xsl:attribute>
					</xsl:if>
					
					<xsl:if test="descendant-or-self::node[@id=$id]">
						<xsl:attribute name='class'>collapse show</xsl:attribute>
					</xsl:if>

					<nav id="drawerAccordion{$alias}" class="drawer-menu-nested nav accordion">
						<xsl:apply-templates select='node' />
					</nav>

				</div>
			</xsl:if>
		</xsl:if>
	</xsl:template>
</xsl:stylesheet>